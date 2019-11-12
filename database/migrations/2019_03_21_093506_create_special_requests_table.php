<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('no_document')->nullable();
            $table->string('request_type')->nullable() ;
            $table->string('part_number')->nullable();
            $table->string('engine_name')->nullable();
            $table->string('vendor_manufacturer')->nullable();
            $table->string('aircraft_type')->nullable();
            $table->string('ata_chapter')->nullable();
            $table->string('workshop')->nullable();
            $table->json('for_rating')->nullable();
            $table->string('facilities')->nullable();
            $table->string('special_tools')->nullable();
            $table->string('special_equipment')->nullable();
            $table->string('qualified_personel')->nullable();
            $table->string('approved_data')->nullable();
            $table->string('appropriate_rating')->nullable();
            $table->text('attachment')->nullable();
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
        Schema::dropIfExists('special_requests');
    }
}
