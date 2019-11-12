<?php

namespace App\Http\Controllers;
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\ComponentPersonel ;

class ComponentPersonelController extends Controller
{
    public function store(Request $request)
    {
        if($request->nominate == 'Nominated Certifying Staff'){
            $request->validate([
                'name' => 'required',
                'id_number' => 'required',
                'nominate' => 'required',
                // 'staff_authorization' => 'required',
                // 'certificate_competence' => 'required',
                // 'personal_ability' => 'required',
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'id_number' => 'required',
                'nominate' => 'required',
                // 'certificate_competence' => 'required',
                // 'personal_ability' => 'required',
            ]);
        }
        $cek = ComponentPersonel::where('id_number', $request->id_number)->where('request_submittion_id', $request->request_submittion_id)->count() ;

        if($cek > 0){
            $res = ['status' => 0, 'message' => 'Your ID '.$request->id_number.' with name '.$request->name.' ID Alerady Addeed'] ;
        }else{
            $save = ComponentPersonel::create($request->all()) ;
            if($save){
                $res = ['status' => 1, 'message' => 'success', 'data' => $save] ;
            }else{
                $res = ['status' => 0, 'message' => 'failed'] ;
            }
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
                $file->move('uploads/component/personel/', $fileName);
                $converter->convert('uploads/component/personel/'.$fileName, '1.4');
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

    public function destroy($id){
        $del = ComponentPersonel::find($id) ;
        $del->delete() ;
        if($del){
            $res =  ['status' => 1,'message' => 'delete success'];
        }else{
            $res =  ['status' => 0,'message' => 'delete failed'];
        }
        return $res ;
    }

    public function show($id){
        return ComponentPersonel::find($id) ;
    }

    public function update(Request $request, $id){
      $update = ComponentPersonel::find($id) ;
      $update->update($request->all()) ;
      if($update){
          $data = ComponentPersonel::find($id) ;
          $res =  ['status' => 1,'message' => 'update success', 'data' => $data];
      }else{
          $res =  ['status' => 0,'message' => 'update failed'];
      }
      return $res ;
    }

    public function action_file(Request $request){
        $file_path = public_path().'/uploads/component/personel/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }
}
