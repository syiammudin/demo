<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterRequest ;
class MasterRequestController extends Controller
{
    public function index()
    {
        return MasterRequest::all();
    }

    public function update(Request $request, $id)
    {
        $update = MasterRequest::find($id)->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['jpeg','jpg','png','gif']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('picture/', $fileName);
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

}
