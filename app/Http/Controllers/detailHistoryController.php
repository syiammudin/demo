<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestHistory ;
use App\RequestSubmittion ;
use PDF ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;

class detailHistoryController extends Controller
{
    public function show($id)
    {
        $history = RequestHistory::find($id) ;
        $request = $history->data ;

        $cek = RequestSubmittion::with(['ComponentRequest'])->find($history->request_submittion_id) ;

        if($cek->master_request_id == 1){
            $pdf = PDF::loadView('detail.history.historyAircraf', compact('request'));
        }

        if($cek->master_request_id == 2){
            $m = new Merger();
            if($cek->ComponentRequest->component_type == 'TCE'){
                $pdf = PDF::loadView('detail.history.historyComponentTCE', ['request' => $request, 'type' => 'potrait'] )->setPaper('a4', 'portrait');
                $m->addRaw($pdf->output());

                $pdf = PDF::loadView('detail.history.historyComponentTCE',  ['request' => $request, 'type' => 'lanscape'])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());

            }

            if($cek->ComponentRequest->component_type == 'TCA'){
                $pdf = PDF::loadView('detail.history.historyComponentTCA', ['request' => $request, 'type' => 'potrait'] )->setPaper('a4', 'portrait');
                $m->addRaw($pdf->output());

                $pdf = PDF::loadView('detail.history.historyComponentTCA',  ['request' => $request, 'type' => 'lanscape'])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());
            }

            if($cek->ComponentRequest->component_type == 'TBR'){
                $pdf = PDF::loadView('detail.history.historyComponentTBR', ['request' => $request, 'type' => 'potrait'] )->setPaper('a4', 'portrait');
                $m->addRaw($pdf->output());

                $pdf = PDF::loadView('detail.history.historyComponentTBR',  ['request' => $request, 'type' => 'lanscape'])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());
            }

            foreach ($request['component_equivalent'] as $equivalent) {
                    $pdf = PDF::loadView('detail.history.ComponentEquivalentHistory', ['equivalent' => $equivalent ,'request' => $request, 'type' => 'potrait2'] )->setPaper('a4', 'potrait');
                    $m->addRaw($pdf->output());

                    $pdf = PDF::loadView('detail.history.ComponentEquivalentHistory', ['equivalent' => $equivalent ,'request' => $request, 'type' => 'lanscape2'] )->setPaper('a4', 'landscape');
                    $m->addRaw($pdf->output());
            }


            file_put_contents('document_n_import/component/ComponentHistory.pdf', $m->merge());

            return response()->file('document_n_import/component/ComponentHistory.pdf');

        }


        if($cek->master_request_id == 3){
            // return $request;
            $m = new Merger();

            $pdf = PDF::loadView('detail.history.historyEngine', ['request' => $request, 'type' => 'potrait'] )->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.history.historyEngine',  ['request' => $request, 'type' => 'lanscape'])->setPaper('a4', 'landscape');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.history.historyEngine',  ['request' => $request, 'type' => 'potrait2'])->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            file_put_contents('document_n_import/engine/engineHistory.pdf', $m->merge());

            return response()->file('document_n_import/engine/engineHistory.pdf');
        }

        if($cek->master_request_id == 4){
            $m = new Merger();

            $pdf = PDF::loadView('detail.history.historySpecial', ['request' => $request, 'type' => 'potrait'] )->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.history.historySpecial',  ['request' => $request, 'type' => 'lanscape'])->setPaper('a4', 'landscape');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.history.historySpecial',  ['request' => $request, 'type' => 'potrait2'])->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            file_put_contents('document_n_import/special/historySpecial.pdf', $m->merge());
            return response()->file('document_n_import/special/historySpecial.pdf');
        }

        return $pdf->stream();
    }

    public function vendor($id)
    {
        $m = new Merger();
        $vendor = \App\VendorManagementHistory::find($id)->data ;

        $pdf = PDF::loadView('detail.history.vendor_management_history', compact('vendor'));
        $m->addRaw($pdf->output());
        if($vendor['attachment'] != null){
            $m->addFile('uploads/vendor_management/'.$vendor['attachment']);
        }

        file_put_contents('document_n_import/vendor/vendorHistory.pdf', $m->merge());

        return response()->file('document_n_import/vendor/vendorHistory.pdf');

        return $pdf->stream();
    }
}
