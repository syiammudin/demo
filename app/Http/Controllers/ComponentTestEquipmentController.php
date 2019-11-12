<?php

namespace App\Http\Controllers;

use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;

use Illuminate\Http\Request;
use App\ComponentTestEquipment ;
use App\ComponentEquivalent ;

class ComponentTestEquipmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'part_name' => 'required',
            'part_number' => 'required',
            'available' => 'required',
            // 'remark' => 'required',
        ]);


        $save = ComponentTestEquipment::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success', 'data' => $save] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function show($id) {
        return ComponentTestEquipment::find($id) ;
    }

    public function update(Request $request, $id){
      $update = ComponentTestEquipment::find($id) ;
      $update->update($request->all()) ;
      if($update){
          $res = ['status' => 1, 'message' => 'success', 'data' => ComponentTestEquipment::find($id) ] ;
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
                $file->move('uploads/component/test_equipment/', $fileName);
                $converter->convert('uploads/component/test_equipment/'.$fileName, '1.4');
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
        $del = ComponentTestEquipment::find($id) ;
        $cek = ComponentEquivalent::where('component_test_equipment_id', $id)->count() ;
        if($cek >= 1){
            ComponentEquivalent::where('component_test_equipment_id', $id)->delete();
        }
        $del->delete() ;
        if($del){
            $res =  ['status' => 1,'message' => 'delete success'];
        }else{
            $res =  ['status' => 0,'message' => 'delete failed'];
        }
        return $res ;
    }

    public function action_file(Request $request){
        $file_path = public_path().'/uploads/component/test_equipment/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }
}
