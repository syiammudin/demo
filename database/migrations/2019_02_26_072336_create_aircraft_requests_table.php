<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('number')->nullable() ;
            $table->string('aircraft_type')->nullable();
            $table->string('aircraft_manufacturer')->nullable();
            $table->string('maintenance_area')->nullable();
            $table->string('manager_statement')->nullable();
            $table->string('ability_a_check')->default('0');
            $table->string('ability_c_check')->default('0');
            $table->string('ability_d_check')->default('0');
            $table->string('ability_other_maintenance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aircraft_requests');
    }
}
