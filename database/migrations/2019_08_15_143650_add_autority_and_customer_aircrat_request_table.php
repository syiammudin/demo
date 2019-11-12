<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutorityAndCustomerAircratRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->string('customer')->nullable() ;
            $table->string('authority')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircraft_reque=aircraft_requests', function (Blueprint $table) {
            //
        });
    }
}
