<?php

namespace App\Http\Controllers;
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\Nda ;
use PDF ;
use App\VendorManagementHistory ;
use Auth ;

class DemoNdaController extends Controller
{
  public function index(Request $request){
      return Nda::with('VendorManagementHistory','User')->paginate($request->pageSize) ;
  }

  public function show($id){
      return Nda::get();
  }

  public function store(Request $request){
    $input = $request->all() ;
    $input['user_id'] = auth::user()->id ;
    $input['status'] = 0 ;

    $save = Nda::create($input) ;
    if($save){
      $res = ['status' => 1, 'message' => 'Success'] ;
    }else {
      $res = ['status' => 0, 'message' => 'Failed'] ;
    }

    return $res ;
  }

  public function update(Request $request, $id ){
      $input = $request->all() ;
      $update = Nda::find($id) ;
      $update->update($input) ;
      if($update){
        $res = ['status' => 1, 'message' => 'Success'] ;
      }else {
        $res = ['status' => 0, 'message' => 'Failed'] ;
      }

      return $res ;
  }

  public function approve(Request $request, $id){
    $input = $request->all() ;

    if(auth::user()->role == 2){
      $input['status'] = 1 ;
    }
    if(auth::user()->role == 3){
      $input['status'] = 2 ;
    }
    if(auth::user()->role == 4){
      $input['status'] = 3 ;
    }
    if(auth::user()->role == 5){
      $input['status'] = 4 ;
    }
    if(auth::user()->role == 6){
      $input['status'] = 5 ;
    }

    $update = Nda::find($id) ;
    $update->update($input) ;
    if($update){
      $history['user_id'] = auth::user()->id ;
      $history['vendor_management_id'] = $update->id ;
      $history['status'] = $input['status'];
      VendorManagementHistory::create($history) ;

      $res = ['status' => 1, 'message' => 'Success'] ;
    }else {
      $res = ['status' => 0, 'message' => 'Failed'] ;
    }

    return $res ;
  }

  public function reject(Request $request, $id ){
    $input = $request->all() ;
    $input['status'] = 4 ;

    $update = Nda::find($id) ;
    $update->update($input) ;

    if($update){
      $history['user_id'] = auth::user()->id ;
      $history['vendor_management_id'] = $update->id ;
      $history['status'] = $input['status'];
      $history['note'] = $request->note ;
      VendorManagementHistory::create($history) ;

      $res = ['status' => 1, 'message' => 'Success'] ;
    }else {
      $res = ['status' => 0, 'message' => 'Failed'] ;
    }

    return $res ;
  }

  public function upload(Request $request)
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
            $file->move('uploads/demo/', $fileName);
            $converter->convert('uploads/demo/'.$fileName, '1.4');
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

  public function detail($id){
    $request = Nda::with('user')->find($id) ;
    $pdf = PDF::loadView('detail.demo',  ['request' => $request])->setPaper('a4', 'potrait');
    return $pdf->stream();
  }

}
