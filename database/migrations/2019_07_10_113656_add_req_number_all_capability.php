<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReqNumberAllCapability extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->string('request_number')->after('id')->nullable() ;
        });
        Schema::table('special_requests', function (Blueprint $table) {
            $table->string('request_number')->after('id')->nullable() ;
        });
        Schema::table('component_requests', function (Blueprint $table) {
            $table->string('request_number')->after('id')->nullable() ;
        });
        Schema::table('engine_requests', function (Blueprint $table) {
            $table->string('request_number')->after('id')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
