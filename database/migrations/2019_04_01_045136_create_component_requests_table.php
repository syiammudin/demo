<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('component_type')->nullable();
            $table->string('document_component_number')->nullable() ;
            $table->string('component_name')->nullable() ;
            $table->string('vendor_manufacturer')->nullable() ;
            $table->string('aircraft_type')->nullable() ;
            $table->string('ata_chapter')->nullable() ;
            $table->string('workshop')->nullable() ;
            $table->json('for_rating')->nullable() ;
            $table->json('aproval_request_carry_out')->nullable() ;
            $table->json('manager_statement')->nullable() ;
            $table->string('part_number')->nullable() ;
            $table->string('status')->default('0');
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
        Schema::dropIfExists('component_requests');
    }
}
