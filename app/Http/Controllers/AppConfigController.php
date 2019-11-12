<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App ;

class AppConfigController extends Controller
{
    public function show($id){
        return App::find($id) ;
    }

    public function update(Request $request, $id){
        $save = App::find($request->id) ;
        $save->update($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 1, 'message' => 'success'] ;
        }
        return $res ;
    }

    public function attachment(Request $request)
    {
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['png','jpeg','jpg']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('uploads/WebConfig/', $fileName);
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
        $file_path = public_path().'/uploads/WebConfig/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }
}
