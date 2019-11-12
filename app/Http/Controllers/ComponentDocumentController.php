<?php

namespace App\Http\Controllers;
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\ComponentDocument ;

class ComponentDocumentController extends Controller
{
    public function store(Request $request)
    {
        if($request->document_type == 'Maintenance Manual'){
          $request->validate([
            'no_document' => 'required',
            'document_type' => 'required',
            'rev_date' => 'required',
            'rev' => 'required',
            // 'attachment' => 'required',
          ]);
        }else{
          $request->validate([
            'no_document' => 'required',
            'document_type' => 'required',
          ]);

        }

        $save = ComponentDocument::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success', 'data' => $save] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function show($id){
        return ComponentDocument::find($id) ;
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_document' => 'required',
            'document_type' => 'required',
            'rev_date' => 'required',
            'rev' => 'required',
            // 'attachment' => 'required',
        ]);

        $update = ComponentDocument::find($id) ;
        $save = $update->update($request->all());
        if($save){
            $data = ComponentDocument::find($id) ;
            $res = ['status' => 1, 'message' => 'success', 'data' => $data] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
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
                $file->move('uploads/component/document/', $fileName);
                $converter->convert('uploads/component/document/'.$fileName, '1.4');
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

    public function destroy($id)
    {
        $del = ComponentDocument::find($id) ;
        $del->delete() ;
        if($del){
            $res =  ['status' => 1,'message' => 'delete success'];
        }else{
            $res =  ['status' => 0,'message' => 'delete failed'];
        }
        return $res ;
    }

    public function action_file(Request $request){
        $file_path = public_path().'/uploads/component/document/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }

}
