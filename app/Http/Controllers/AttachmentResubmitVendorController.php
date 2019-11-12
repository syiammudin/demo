<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttachmentResubmitVendor ;

class AttachmentResubmitVendorController extends Controller
{
    public function show(Request $request, $id){
        return AttachmentResubmitVendor::where('request_submittion_id', $id)->get();
    }

    public function store(Request $request){
        $save  = AttachmentResubmitVendor::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success', 'data' => $save ] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function attachment(Request $request)
    {
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['jpg','jpeg','png']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('uploads/vendor/resubmit/', $fileName);
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
        $file_path = public_path().'uploads/vendor/resubmit/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }
}
