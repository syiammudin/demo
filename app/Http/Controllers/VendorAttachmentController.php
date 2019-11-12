<?php

namespace App\Http\Controllers;

use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\VendorManagement ;
use PDF ;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailToVendor ;

class VendorAttachmentController extends Controller
{
    public function index(Request $request, $id, $token)
    {
        $decript = base64_decode(base64_decode(base64_decode($id)));
        $data = VendorManagement::with(['VendorManagementHistory','VendorAttachment'])->find($decript) ;
        if($token == $data->token){
            return view('vendor_attachment.attachment', compact('data')) ;
        }else{
            return ['status' => false, 'message' => 'Your Tokent Wrong'] ;
        }
    }

    public function store(Request $request){
        $request->validate([
            'from' => 'required' ,
            'to' => 'required' ,
            'phone' => 'required|numeric' ,
            'vendor_name' => 'required' ,
            'vendor_address' => 'required' ,
            'vendor_city' => 'required' ,
            'vendor_state' => 'required' ,
            'vendor_zip_code' => 'required|numeric' ,
            'vendor_phone' => 'required|numeric' ,
            'vendor_fax' => 'required|numeric' ,
            'parent_company' => 'required' ,
            'item_proposed' => 'required' ,
            'aplication_drawing' => 'required' ,
            'type_supplier' => 'required' ,
            'contact_name' => 'required' ,
            'contact_email' => 'required|email' ,
            'contact_title' => 'required' ,
            'supplier_code' => 'required' ,
            //from vendor
            'type_bussines' => 'required',
            'age_organization' => 'required',
            'total_employee' => 'required',
            'total_supervisors' => 'required',
            'total_inspectors' => 'required',
            'total_personel' => 'required',
            'list_name_aproval' => 'required',
            'list_customers' => 'required',
            'representative_indonesia' => 'required',
            'document_evidence' => 'required',
        ]);

        $save = VendorManagement::find($request->id) ;
        $input = $request->all() ;
        $input['status_vendor'] = 1 ;
        $save->update($input) ;

        if($save){
            $res = ['status' => 1, 'message' => 'success', 'id' => $save->id] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function show($id)
    {
        return VendorManagement::with(['VendorManagementHistory','VendorAttachment'])->find($id);
    }

    public function update(Request $request, $id)
    {
        $vendor = VendorManagement::find($id);
        $vendor->update($request->all()) ;

        if($vendor){
            $res = ['status' => 1, 'message' => 'success', 'id' => $vendor->id] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function print($id){
        $vendor = VendorManagement::find($id) ;

        $pdf = PDF::loadView('detail.ForVendor', compact('vendor'))->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream();
    }

    public function attachment(Request $request){
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
                $file->move('uploads/vendor_management/', $fileName);
                $converter->convert('uploads/vendor_management/'.$fileName, '1.4');
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
        $file_path = public_path().'/uploads/vendor_management/'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }

    public function vendor_attachment(Request $request, $id){
        $attacment = \App\VendorAttachment::find($id) ;
        $attacment->update($request->all()) ;
        if($attacment){
            $res = ['status' => 1, 'message' => 'success', 'id' => $attacment->id] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function sendAttachment(Request $request){
        $vendor = VendorManagement::find($request->id) ;
        $input['status'] = 7 ;
        $vendor->update($input) ;
        $vendor['to_user'] = 'OK' ;
        Mail::to($vendor->User->email)->queue(new MailToVendor($vendor));
    }

}
