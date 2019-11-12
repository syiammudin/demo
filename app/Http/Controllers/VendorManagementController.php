<?php

namespace App\Http\Controllers;

use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\VendorManagement;
use App\VendorManagementHistory;
use App\VendorAttachment;
use App\Http\Requests\VendorManagementValidate;
use Auth ;
use PDF ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailToVendor ;
use App\Mail\SubmitRequestVendor ;
use App\Mail\ChekedRequestVendor ;
use App\Mail\NotificationUserVendor ;
use App\Mail\SendMessageToVendor ;


class VendorManagementController extends Controller
{
    public function index(Request $request)
    {
      return VendorManagement::with(['VendorManagementHistory'])->selectRaw('users.name as name, vendor_managements .*')
            ->join('users', 'users.id','=', 'vendor_managements.user_id')
            ->when($request->search, function($q) use ($request) {
                return $q->where(function($qq) use ($request) {
                  return $qq->where('request_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('type_supplier', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('dept', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('vendor_name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('contact_email', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('contact_name', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('contact_title', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('vendor_managements.created_at', 'LIKE', '%'.$request->search.'%');
                });
            })
            ->when($request->status, function($q) use ($request) {
                return $q->whereIn('status', $request->status);
            })
            ->when($request->type_supplier, function($q) use ($request) {
                return $q->where('type_supplier', 'LIKE', '%'.$request->type_supplier.'%');
            })
            ->when($request->dept, function($q) use ($request) {
                return $q->where('dept', 'LIKE', '%'.$request->dept.'%');
            })
            ->when($request->vendor_name, function($q) use ($request) {
                return $q->where('vendor_name', 'LIKE', '%'.$request->vendor_name.'%');
            })
            ->when(in_array(auth()->user()->role, ['1','4']), function($q) {
                return $q->where('status', '!=', 0);
            })
            ->when(auth()->user()->role == 3, function($q) {
                return $q->where('user_id', auth()->user()->id)->orWhere('status', '>=', 1);
            })
            ->when(auth()->user()->role == 2, function($q) {
                return $q->where('user_id', auth()->user()->id);
            })->when(auth()->user()->role == 5, function($q) use ($request) {
                if ($request->type) {
                  return $q->whereIn('status',[3,8]);
                }
                return $q->whereIn('status',[4,5,6]);
            })->when(auth()->user()->role == 6, function($q) use ($request) {
              if ($request->type) {
                return $q->whereIn('status',[4]);
              }
              return $q->whereIn('status',[4,5,6]);
            })
            ->orderBy($request->sort ? $request->sort : 'request_number', $request->order == 'ascending' ? 'asc' : 'desc')
            ->paginate($request->pageSize) ;
    }
    public function store(VendorManagementValidate $request)
    {

        // return  $lengt;
        $input = $request->all() ;
        foreach (explode(", ",$request->attachment_lenght) as $key) {
            $lengt[] = array('name_attachment' => $key) ;
        }

        if($request->id){
            $save = VendorManagement::find($request->id) ;

            if($save->type_supplier != $request->type_supplier){
                $del = VendorAttachment::where('vendor_management_id', $save->id) ;
                $del->delete();
                $save->VendorAttachment()->createMany($lengt) ;
            }
            $save->update($input);
        }else{
            $input['user_id'] = auth::user()->id ;
            $input['list_name_aproval'] = "[]" ;
            $input['list_customers'] = "[]" ;
            $input['type_bussines'] = "{}" ;
            $input['document_evidence'] = "{}" ;

            $input['token'] = md5(date('his')) ;
            $save = VendorManagement::create($input);
            $save->VendorAttachment()->createMany($lengt) ;
        }

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

    // for send mail to vendor
    public function update(Request $request, $id){
        $vendor = VendorManagement::find($id) ;
        $encript = base64_encode(base64_encode(base64_encode($id)));
        $link = url("/vendor_attact/".$encript."/".$vendor->token);

        $vendor['link'] = $link ;

        Mail::to($vendor->contact_email)->queue(new MailToVendor($vendor));

        return ['status' => 1, 'message' => 'success'] ;
    }

    public function submit(Request $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $input['questionnaire_exp_date'] = date('Y-m-d', strtotime('+2 years'));
        if($request->request_number == null){
          $input['request_number'] = $this->request_number();
        }
        $input['submit_date'] = date('Y-m-d') ;

        if($request->id){
            $input['status'] = 1 ;
            $save = VendorManagement::find($request->id) ;
            $save->update($input);
            $input['vendor_management_id'] = $request->id ;
        }else{
            $input = $request->all() ;
            $save = VendorManagement::create($input);
            $input['vendor_management_id'] = $save->id ;
        }

        VendorManagementHistory::create($input) ;

        $data = VendorManagement::with(['VendorManagementHistory','VendorAttachment'])->find($save->id) ;
        $gm = \App\User::where('role', 3)->where('role_request', 5)->first() ;
        Mail::to($gm->email)->queue(new SubmitRequestVendor($data));

        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function destroy($id)
    {
        $delete = VendorManagement::find($id)->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
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

    public function detail($id)
    {
        $m = new Merger();
        $vendor = VendorManagement::with(['VendorAttachment','VendorManagementHistory'])->find($id) ;
        $pdf = PDF::loadView('detail.vendor_management', compact('vendor'))->setOptions(['isPhpEnabled' => true]);
        $m->addRaw($pdf->output());

        if($vendor->attachment != null){
            if(file_exists('uploads/vendor_management/'.$vendor->attachment)){
                $m->addFile('uploads/vendor_management/'.$vendor->attachment);
            }
        }

        foreach ($vendor->VendorAttachment as $doc) {
            if($doc->attachment != null){
                if(file_exists('uploads/vendor_management/'.$doc->attachment)){
                    $m->addFile('uploads/vendor_management/'.$doc->attachment);
                }
            }
        }

        if($vendor->decision != null){
            $pdf = PDF::loadView('detail.vendorDecision', compact('vendor'))->setOptions(['isPhpEnabled' => true]);
            $m->addRaw($pdf->output());
        }

        file_put_contents('document_n_import/vendor/vendor.pdf', $m->merge());

        if(auth::user()->role == 5 || auth::user()->role == 6){
          $data = array('documents' => 'document_n_import/vendor/vendor.pdf' , 'id' => $id );
          return view('decision.DecisionVendor', compact('data'));
        }else{
          return response()->file('document_n_import/vendor/vendor.pdf');
        }



        return $pdf->stream();
    }

    public function checked($id)
    {
        if(auth::user()->role == 3){
            $input['status'] = 2 ;
            $qsa = \App\User::where('role', 4)->where('role_request', 5)->first() ;
        }
        if(auth::user()->role == 4){
            $input['status'] = 3 ;
            $qsa = \App\User::where('role', 5)->first() ;
        }

        $update = VendorManagement::find($id) ;
        $update->update($input) ;
        $input['vendor_management_id'] = $id ;

        $input['user_id'] = auth::user()->id ;
        VendorManagementHistory::create($input);

        $data = VendorManagement::with(['VendorManagementHistory'])->find($update->id) ;

        Mail::to($qsa->email)->queue(new ChekedRequestVendor($data));
        Mail::to($data->User->email)->queue(new NotificationUserVendor($data));

        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function reject(Request $request, $id){
        $input = $request->all() ;
        if(auth::user()->role == 6){
            $input['status'] = 8 ;
        }else{
            $input['status'] = 6 ;
        }
        $input['read'] = null ;
        $update = VendorManagement::find($id);
        $update->update($input) ;
        $input['vendor_management_id'] = $id ;
        $input['user_id'] = auth::user()->id ;
        $reject = VendorManagementHistory::create($input);

        $data = VendorManagement::with(['VendorManagementHistory'])->find($id);
        VendorManagementHistory::find($reject->id)->update(['data' => $data]) ;

        Mail::to($data->User->email)->queue(new NotificationUserVendor($data));
        if($reject){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function approve(Request $request, $id)
    {
        $input = $request->all() ;
        if(auth::user()->role == 5){
            if($request->main_fn){
                for ($i=0; $i < count($request->main_fn) ; $i++) {
                    \App\MainFn::firstOrCreate(array('label' => $request->main_fn[$i]));
                }
                $input['maint_fn'] = implode(', ', $request->main_fn );
            }
            $input['status'] = 4 ;
            $role = 6 ;
        }
        if(auth::user()->role == 6){
            $input['status'] = 5 ;
            $role = 5;
        }
        $input['product_service'] = $request->product_service ;
        $qsa = \App\User::where('role', $role )->first() ;

        $update = VendorManagement::find($id) ;
        $update->update($input) ;
        $input['vendor_management_id'] = $id ;
        $input['user_id'] = auth::user()->id ;
        $history = VendorManagementHistory::create($input);
        $data = VendorManagement::with(['VendorManagementHistory'])->find($id);

        VendorManagementHistory::find($history->id)->update(['data' => $data]) ;

        $data['type'] = 'vendor' ;

        if(auth::user()->role == 5){
            Mail::to($qsa->email)->queue(new ChekedRequestVendor($data));
        }else{
            Mail::to($data->User->email)->queue(new NotificationUserVendor($data));
        }

        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function read($id){
        if(auth::user()->role == 3 or auth::user()->role == 4 or auth::user()->role == 5 or auth::user()->role == 6){
            $request = VendorManagement::find($id) ;
            if($request->status_read == null){
                $input['read'] = "|". auth::user()->id ;
            }else{
                $cek = explode('|',$request->status_read) ;
                if (in_array(auth::user()->id ,$cek)) {
                    $input['read'] = $request->status_read ;
                }else{
                    $input['read'] = $request->status_read."|". auth::user()->id ;
                }
            }
            if(auth::user()->role == 5 and $request->qsa_part_approve == null){
              $input['qsa_part_approve'] = auth::user()->id ;
            }
            $request->update($input) ;
        }

        return 'success';
    }

    public function sendemail(Request $request){

        $data = $request->all() ;

        Mail::to($request->email)->queue(new SendMessageToVendor($data));

        return "ok";
    }

    public function request_number(){
        $request = VendorManagement::where('request_number','<>', null)->orderBy('request_number','desc')->first();
        if($request){
            $cek = str_replace('VN','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 9){
            $number = 'VN00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = 'VN0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = 'VN000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = 'VN00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = 'VN0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = 'VN'.($cek+1) ;
        }

        return $number ;
    }
}
