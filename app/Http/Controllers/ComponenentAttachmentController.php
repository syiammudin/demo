<?php

namespace App\Http\Controllers;
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\ComponentAttachment ;

class ComponenentAttachmentController extends Controller
{

    public function store(Request $request)
    {
        $cek = ComponentAttachment::where('request_submittion_id', $request->request_submittion_id)->count() ;
        if($cek == 1){
            $update = ComponentAttachment::where('request_submittion_id', $request->request_submittion_id)->first() ;
            $save = $update->update($request->all()) ;
        }else{
            $save = ComponentAttachment::create($request->all()) ;
        }

        if($save){
            $res = [ 'status' => 1, 'message' => 'Success Save'];
        }else{
            $res = [ 'status' => 0, 'message' => 'Failed Save'];
        }

        return $res ;
    }

    public function attachment(Request $request)
    {
      $command = new GhostscriptConverterCommand();
      $filesystem = new Filesystem();
      $converter = new GhostscriptConverter($command, $filesystem);

        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['pdf']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('uploads/component/attachment/', $fileName);
                $converter->convert('uploads/component/attachment/'.$fileName, '1.4');
            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Failed to move file'
                ];
            }

            return [
                'success' => true,
                'file' => $fileName,
                'index' => $request->index,
                'message' => 'OK'
            ];
        }
    }

    public function action_file(Request $request){
        $file_path = public_path().'/uploads/component/attachment/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }

    public function update(Request $request, $id){
        $del = ComponentAttachment::where('request_submittion_id', $id)->first() ;
        $input[$request->doc] = null ;
        $del->update($input) ;
        return 'ok' ;
    }
}
