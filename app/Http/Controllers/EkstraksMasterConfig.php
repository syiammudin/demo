<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterConfig ;
use App\RequestSubmittion ;
use App\AircraftRequest ;
use App\ComponentRequest ;
use App\ComponentShopAbility ;
use App\ComponentDocument ;
use App\ComponentPersonel ;
use App\ComponentTestEquipment ;
use App\ComponentSpecialTool ;
use App\ComponentMaterialPlanning ;
use App\ComponentManhoursPlanning ;
use App\ComponentAttachment ;
use App\AttachmentResubmit ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use App\Http\Controllers\store\StoreController;
use auth ;

class EkstraksMasterConfig extends Controller
{
    public function index(Request $request){

        if(auth::user()->role_request == 4){
            $data = MasterConfig::where('master_request_id', 4)->get() ;
        }
        if(auth::user()->role_request == 3){
            if(!empty($request->type)){
                $data = MasterConfig::where('master_request_id', 3)->get() ;
            }else{
                $data = MasterConfig::where('master_request_id', 2)->where('component_type', 'Engine')->get() ;
            }
        }
        if(auth::user()->role_request == 2){
            $data = MasterConfig::where('master_request_id', 2)->get() ;
        }
        if(auth::user()->role_request == 1){
            $data = MasterConfig::where('master_request_id', 1)->get() ;
        }

        return $data ;
    }

    // this show just for testing
    public function show($id){
        $m = new Merger();
        $m->addFile('uploads/vendor_management/15665415891566533527DGCA01_RSM_&_QCM_R1_2017-12-26.pdf');
        $m->addFile('uploads/vendor_management/15665415891566533527DGCA01_RSM_&_QCM_R1_2017-12-26.pdf');
        $m->addFile('uploads/vendor_management/1564718782Project-Status-QApps-19-04-2019.pdf');
        $m->addFile('uploads/vendor_management/1564718782Project-Status-QApps-19-04-2019.pdf');
        file_put_contents('uploads/vendor_management/contoh.pdf', $m->merge());
        return response()->file('uploads/vendor_management/contoh.pdf');

    }

    public function store(Request $request){
        $input = $request->all();
        $input['user_id'] = auth::user()->id;
        $save = RequestSubmittion::create($input) ;
        return $input;
    }
}
