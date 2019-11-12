<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSubmitDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_submittions', function (Blueprint $table) {
            $table->date('submit_date')->nullable() ;
        });
        Schema::table('vendor_managements', function (Blueprint $table) {
            $table->date('submit_date')->nullable() ;
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
