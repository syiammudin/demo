<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarkDeletionTbReqSubmittions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_submittions', function (Blueprint $table) {
            $table->string('remark_deletion')->nullable() ;
            $table->date('date_approve')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_submittions', function (Blueprint $table) {
            //
        });
    }
}
