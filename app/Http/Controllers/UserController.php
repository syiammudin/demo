<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return User::where('id','<>',1)->get();
    }

    public function show($id)
    {
        return User::find($id) ;
        // foreach (scandir('uploads/users/signature') as $key) {
        //     if($key != '.' and $key != '..' ){
        //         $user = User::where('signature', $key)->first() ;
        //         if($user){
        //             echo $key.' ada di database <br/>' ;
        //         }else{
        //             $file_path = public_path().'/uploads/users/signature/'.$key;
        //             if(file_exists($file_path)){
        //                 unlink($file_path);
        //             }
        //             echo $key.' Tidak ada di database wajib di hapus<br/>' ;
        //         }
        //     }
        // }
        // return '' ;

    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'id_number' => 'required|unique:users',
            'position_name' => 'required',
            'unit_code' => 'required',
            'role' => 'required',
            'role_request' => 'required',
        ]);

        $input = $request->all() ;
        $input['password'] = bcrypt($request->password) ;
        $save = User::create($input) ;

        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id) ;
        $input = $request->all() ;
        if(!empty($request->password)){
            $input['password'] = bcrypt($request->password) ;
        }
        $update = $user->update($input) ;

        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $user = User::find($id) ;
        $delete = $user->delete();
        if($delete){
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

            if (!in_array(strtolower($extension), ['png']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                $file->move('uploads/users/signature/', $fileName);
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

            return [
                'success' => true,
                'file' => $fileName,
                'index' => $request->index,
                'message' => 'OK'
            ];
        }
    }

    public function action_file(Request $request){
        $cek = User::find($request->id) ;
        if($cek->signature == null || $request->id == 'undefined' ){
            return 'belum ada signature';
        }else{
            if(!empty($request->type)){
                return 'remove temporary' ;
            }else{
                $input['signature'] = $request->signature ;
                User::find($request->id)->update($input) ;

                $file_path = public_path().'/uploads/users/signature/'.$request->file;
                if(file_exists($file_path)){
                    unlink($file_path);
                }
                return $request->all() ;

            }
        }
    }
}
