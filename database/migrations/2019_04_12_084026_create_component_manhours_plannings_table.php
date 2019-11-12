<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentManhoursPlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_manhours_plannings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('part_number')->nullable() ;
            $table->string('part_description')->nullable();
            $table->string('qty')->nullable() ;
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
        Schema::dropIfExists('component_manhours_plannings');
    }
}
