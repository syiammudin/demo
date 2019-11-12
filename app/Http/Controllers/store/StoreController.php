<?php

namespace App\Http\Controllers\store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth ;
use App\TabelApi;
use App\MaintenanceArea;
use App\RequestSubmittion ;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\ConnectException;

class StoreController extends Controller
{
    //show data maintenance area
    public function index()
    {
        return MaintenanceArea::get() ;
    }

    public function hangar($id){
        return \App\Hangar::get() ;
    }

    public function questionare($id){
        return \App\Questionnaire::get() ;
    }

    // show data role
    public function show($id){
        // return "cek";
        $role = array(
                        ['id' => 1, 'role' => 'Admin'],
                        ['id' => 2, 'role' => 'User'],
                        ['id' => 3, 'role' => 'Manager'],
                        ['id' => 4, 'role' => 'HRD'],
                        // ['id' => 5, 'role' => 'QSA'],
                        // ['id' => 6, 'role' => 'GM QSA'],
                     );

        return $role ;
    }

    public function role_request($id){
        // return "cek";
        $request = array(
                        ['id' => 1, 'name' => 'Aircraft Capability Request'],
                        ['id' => 2, 'name' => 'Component Capability Request'],
                        ['id' => 3, 'name' => 'Engine Capability Request'],
                        ['id' => 4, 'name' => 'Special Process Request'],
                        ['id' => 6, 'name' => 'Special Process Request'],
                        ['id' => 6, 'name' => 'Demo Request']
                     );

        return $request ;
    }

    // show data status request
    public function status($id){
        $status = array(
                        ['id' => 0, 'status' => 'Draft', 'notif' => 'alert-light'],
                        ['id' => 1, 'status' => 'Submitted to Manager', 'notif' => 'alert-warning'],
                        ['id' => 2, 'status' => 'Submitted to HRD', 'notif' => 'alert-info'],
                        ['id' => 3, 'status' => 'Completed', 'notif' => 'alert-success'],
                        ['id' => 4, 'status' => 'Reject', 'notif' => 'alert-danger'],
                        // ['id' => 0, 'status' => 'Draft', 'notif' => 'alert-light'],
                        // ['id' => 1, 'status' => 'Submitted to Manager', 'notif' => 'alert-warning'],
                        // ['id' => 2, 'status' => 'Submitted to HRD', 'notif' => 'alert-info'],
                        // ['id' => 3, 'status' => 'Submitted to QSA', 'notif' => 'alert-info'],
                        // ['id' => 4, 'status' => 'Submitted to GM QSA', 'notif' => 'alert-info'],
                        // ['id' => 5, 'status' => 'Completed', 'notif' => 'alert-success'],
                        // ['id' => 6, 'status' => 'Reject', 'notif' => 'alert-danger'],
                        // ['id' => 7, 'status' => 'Submitted by Vendor', 'notif' => 'alert-secondary'],
                        // ['id' => 8, 'status' => 'Reject by GM QSA', 'notif' => 'alert-danger'],
                     );

        return $status ;
    }

    public function techpub(Request $request, $id){
        $http = new Client(['timeout' => 30]);
        try {
            if($request->search == null){
                return response(['message' => 'Please select data'], 422);
                // return ["status" => 0, "message" => "no data selected"];
            }else{
                $techpub = TabelApi::where('type','techpub')->first()->api ;
                $par = array('{search_type}', '{search}') ;
                $change = array($request->search_type , $request->search) ;
                $response = $http->request('GET', str_replace($par, $change, $techpub) );
            }
            return  $response->getBody() ;
        } catch (\Exception $e) {
            return response(['message' => 'Failed to fetch data. '.$e->getMessage()], 500);
            // return ['status' => 0 , 'message' => 'No documents were found'];
        }
    }

    public function user_soe($id){
        $http = new Client(['timeout' => 60]);
        // baru $response = $http->request('GET', 'h`ttp://172.16.40.238/codeigniter-restserver/employee_license?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4');
        // lama $response = $http->request('GET', 'http://172.16.40.238/codeigniter-restserver/employee?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4');
        // $response = $http->request('GET', 'http://172.16.40.238/codeigniter-restserver/Employee_amel_gmfauth?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4');

        try {
            $response = $http->request('GET', TabelApi::where('type','soe')->first()->api );
            $result =  json_encode(json_decode($response->getBody())) ;
            $data = json_decode($result, true);
            return  $data['employee'];
        }
        catch (ConnectException $e) {
            return response(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        }

    }

    public function full_user_soe($id){
        $http = new Client;
        $user_soe = TabelApi::where('type','scope_soe')->first()->api ;
        $scope = $http->request('GET', str_replace('{id}', $id, $user_soe)  );
        return $scope;
    }

    public function tools(Request $request, $id){
        $http = new Client;

        if($request->search_type == 'rn'){
            $tool_rn = TabelApi::where('type','tools_rn')->first()->api ;
            $tools = $http->request('GET', str_replace('{search}', $request->search, $tool_rn));
        }
        elseif($request->search_type == 'pn'){
            $tool_pn = TabelApi::where('type','tools_pn')->first()->api ;
            $tools = $http->request('GET',  str_replace('{search}', $request->search, $tool_pn));
        }
        elseif($request->search_type == 'sn'){
            $tool_sn = TabelApi::where('type','tools_sn')->first()->api ;
            $tools = $http->request('GET', str_replace('{search}', $request->search, $tool_sn) );
        }else{
            $tool_all = TabelApi::where('type','tools_all')->first()->api ;
            $tools = $http->request('GET', $tool_all);
        }
        return $tools->getBody() ;
    }

    public function request_number(Request $request){

        if($request->type == 'aircraft'){
            $data = \App\AircraftRequest::orderBy('request_number','desc')->first();
            $code = 'AR' ;
        }
        if($request->type == 'component'){
            $data = \App\ComponentRequest::orderBy('request_number','desc')->first();
            $code = 'CP' ;
        }
        if($request->type == 'engine'){
            $data = \App\EngineRequest::orderBy('request_number','desc')->first();
            $code = 'EN' ;
        }
        if($request->type == 'special'){
            $data = \App\SpecialRequest::orderBy('request_number','desc')->first();
            $code = 'SP' ;
        }

        if($data){
            $cek = str_replace( $code,'', $data->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 9){
            $number = $code.'00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = $code.'0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = $code.'000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = $code.'00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = $code.'0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = $code.($cek+1) ;
        }

        return $number ;
    }


    public function aircraft_type(){
        return \App\AircraftType::get() ;
    }

    public function part_number(){
        return \App\PartNumber::get() ;
    }

    public function PartNumberNew(){
      $cek = \App\MasterConfig::where('master_request_id',2)->select('part_number')->count() ;
      if($cek > 0){
        $part_number = \App\MasterConfig::where('master_request_id',2)->select('part_number')->get() ;
        foreach ($part_number as $v) {
          $data[] = $v->part_number ;
        }
        return \App\PartNumber::whereNotIn('part_number', $data)->get() ;
      }else{
        return \App\PartNumber::get() ;
      }
    }

    public function unit_of_measures(){
        return \App\UnitOfMeasure::get() ;
    }

    public function for_rating()
    {
        return \App\ForRating::select('id','name_of_rating','desciption','form_type')->get();
    }

    public function notification(){
        if(auth::user()->role == 4 && auth::user()->role_request != 5){
            return \App\RequestSubmittion::where('status', 2)->get() ;
        }
        elseif(auth::user()->role_request == 1){
            if(auth::user()->role == 3){
                return \App\RequestSubmittion::where('status', 1)->where('master_request_id', 1)->count() ;
            }
            // if(auth::user()->role == 4){
            //     return \App\RequestSubmittion::where('status', 2)->where('master_request_id', 1)->count() ;
            // }
        }elseif(auth::user()->role_request == 2){
            if(auth::user()->component_type == 'TCE'){
                if(auth::user()->role == 3){
                    return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                    ->where('component_type', 'TCE')->where('request_submittions.status', 1 )->count();
                }
                // if(auth::user()->role == 4){
                //     return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                //     ->where('component_type', 'TCE')->where('request_submittions.status', 2 )->count();
                // }
            }

            if(auth::user()->component_type == 'TCA'){
                if(auth::user()->role == 3){
                    return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                    ->where('component_type', 'TCA')->where('request_submittions.status', 1 )->count();
                }
                // if(auth::user()->role == 4){
                //     return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                //     ->where('component_type', 'TCA')->where('request_submittions.status', 2 )->count();
                // }
            }

            if(auth::user()->component_type == 'TBR'){
                if(auth::user()->role == 3){
                    return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                    ->where('component_type', 'TBR')->where('request_submittions.status', 1 )->count();
                }
                // if(auth::user()->role == 4){
                //     return \App\RequestSubmittion::join('component_requests','component_requests.request_submittion_id','request_submittions.id')
                //     ->where('component_type', 'TBR')->where('request_submittions.status', 2 )->count();
                // }
            }
        }elseif(auth::user()->role_request == 3){
            if(auth::user()->role == 3){
                return \App\RequestSubmittion::where('status', 1)->where('master_request_id', 3)->count() ;
            }
            // if(auth::user()->role == 4){
            //     return \App\RequestSubmittion::where('status', 2)->where('master_request_id', 3)->count() ;
            // }
        }elseif(auth::user()->role_request == 4){
            if(auth::user()->role == 3){
                return \App\RequestSubmittion::where('status', 1)->where('master_request_id', 4)->count() ;
            }
            // if(auth::user()->role == 4){
            //     return \App\RequestSubmittion::where('status', 2)->where('master_request_id', 4)->count() ;
            // }
        }elseif(auth::user()->role_request == 5){
            if(auth::user()->role == 3){
                return \App\VendorManagement::where('status', 1)->count() ;
            }
            // if(auth::user()->role == 4){
            //     return \App\VendorManagement::where('status', 2)->count() ;
            // }
        }else{
            return null ;
        }
    }

    public function workshop($id){
        return \App\Workshop::get() ;
    }

    public function type_supplier($id){
        return \App\TypeSupplier::get() ;
    }

    public function facilities($id){
        return \App\MasterFacility::distinct()->get() ;
    }

    public function main_fn($id){
        return \App\MainFn::get() ;
    }

    public function NdtMethods($id){
        return \App\NdtMethods::get() ;
    }

    public function checkPNComponent($id){
        return \App\MasterConfig::where('master_request_id', 2)
                ->when(Auth::user()->role_request == 3, function($q) {
                    return $q->where('component_type', 'Engine');
                })
                ->get() ;
    }

    public function checkPNEngine($id){
        return \App\MasterConfig::where('master_request_id', 3)->get() ;
    }

    public function Customer($id){
        return \App\MasterAircraftCustomer::get() ;
    }

    public function Issue($id){
        return \App\Issue::get() ;
    }
    public function shortCaplist(Request $request, $id){
        return \App\CapabilityList::where('type_capability_list', $request->type)->get() ;
    }

}
