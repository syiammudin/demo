<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftMaterialsTable extends Migration
{

    public function up()
    {
        Schema::create('aircraft_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->text('description_material')->nullable();
            $table->string('pn')->nullable() ;
            $table->string('availability')->nullable() ;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aircraft_materials');
    }
}
