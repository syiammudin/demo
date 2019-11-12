<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\RequestSubmittion ;
use App\VendorManagement ;

class DashboardController extends Controller
{
    public function Index(Request $request){
        // return RequestSubmittion::with(['ComponentRequest'])->where('status','<>',0)->get();
        if( Auth::user()->role_request == 5){
            return VendorManagement::where('status','<>',0)->get() ;
        }elseif($request->type){
            return VendorManagement::whereIn('status', array(3,4,8))->get();
        }else{
            if(Auth::user()->role == 5 || Auth::user()->role == 6 || Auth::user()->role == 1){
                return RequestSubmittion::where('status','<>',0)->get();
            }else{
                return RequestSubmittion::get();
            }
        }
    }


    public function show(Request $request, $id){
        $source = [['Year', 'Aircraf', 'Component', 'Engine', 'Special','Vendor']];
        for ($i=1; $i <= 12; $i++) {
            $aircraft = \App\RequestSubmittion::whereMonth('created_at', $i )->whereYear('created_at', $request->years)->where('master_request_id', 1)->where('status','<>', 0)->count() ;
            $component = \App\RequestSubmittion::whereMonth('created_at', $i )->whereYear('created_at', $request->years)->where('master_request_id', 2)->where('status','<>', 0)->count() ;
            $engine = \App\RequestSubmittion::whereMonth('created_at', $i )->whereYear('created_at', $request->years)->where('master_request_id', 3)->where('status','<>', 0)->count() ;
            $special = \App\RequestSubmittion::whereMonth('created_at', $i )->whereYear('created_at', $request->years)->where('master_request_id', 4)->where('status','<>', 0)->count() ;
            $vendor = \App\VendorManagement::whereMonth('created_at', $i )->whereYear('created_at', $request->years)->where('status','<>', 7)->where('status','<>', 0)->count() ;
            $mount = date('M', strtotime('02-'.($i).'-'.date('Y'))) ;

            $source[] = [ $mount , $aircraft, $component, $engine, $special, $vendor] ;
        }

        return $source;
    }

    public function admin($id){
        $data['aircraft'] = \App\RequestSubmittion::where('status','<>',0)->where('master_request_id', 1)->get() ;
        $data['component'] = \App\RequestSubmittion::where('status','<>',0)->where('master_request_id', 2)->get() ;
        $data['engine'] = \App\RequestSubmittion::where('status','<>',0)->where('master_request_id', 3)->get() ;
        $data['special'] = \App\RequestSubmittion::where('status','<>',0)->where('master_request_id', 4)->get() ;
        $data['vendor'] = \App\VendorManagement::where('status','<>',0)->get() ;

        return $data ;
    }

    public function approveReject($id){
        $data['vendor'] = \App\VendorManagement::whereIn('status', [5,6,8])->get() ;
        $data['capability'] = \App\RequestSubmittion::whereIn('status', [5,6,8])->get() ;

        return $data ;
    }

    public function component($id){
      $type = Auth::user()->component_type ;
      return RequestSubmittion::with(['ComponentRequest'])
              ->whereHas('ComponentRequest', function($query) use ($type) {
                  $query->where('component_type', $type);
              })
              ->get();
              // ->where('status','<>',0)->get();
    }

    public function vendor($id){
        return \App\VendorManagement::selectRaw('type_supplier, status, user_id, submit_date')->get() ;
    }

    public function capability($id){
        return \App\RequestSubmittion::selectRaw('request_type, user_id, created_at, submit_date')->get() ;
    }

}
