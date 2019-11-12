<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('no_document')->nullable();
            $table->string('request_type')->nullable();
            $table->string('engine_name')->nullable();
            $table->string('vendor_manufacturer')->nullable();
            $table->string('aircraft_type')->nullable();
            $table->string('ata_chapter')->nullable();
            $table->string('workshop')->nullable();
            $table->string('dgca_rating')->nullable();
            $table->string('faa_rating')->nullable();
            $table->string('easa_rating')->nullable();
            $table->string('facilities')->nullable();
            $table->string('special_tools')->nullable();
            $table->string('special_equipment')->nullable();
            $table->string('qualified_personel')->nullable();
            $table->string('approved_data')->nullable();
            $table->string('appropriate_rating')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('engine_requests');
    }
}
