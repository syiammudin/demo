<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('request_number')->nullable();
            $table->string('request_type')->nullable();
            $table->string('aircraft_type')->nullable() ;
            $table->string('maintenance_area')->nullable() ;
            $table->string('maintenance_area_value')->nullable() ;
            $table->string('ability')->nullable();
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
        Schema::dropIfExists('master_configs');
    }
}
