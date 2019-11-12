<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielDoucmentEvidenceOtherValueAndCalibrationCertificateValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_managements', function (Blueprint $table) {
            $table->json('calibration_lab_certificate_value')->after('document_evidence')->nullable() ;
            $table->json('other_document_evidence_value')->after('document_evidence')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_managements', function (Blueprint $table) {
            //
        });
    }
}
