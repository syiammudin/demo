<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTestEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_test_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('part_number')->nullable();
            $table->string('part_name')->nullable() ;
            $table->string('available')->nullable();
            $table->string('alternate_pn')->nullable() ;
            $table->string('alternate_name')->nullable() ;
            $table->string('remark')->nullable();
            $table->string('equivalent')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('component_test_equipments');
    }
}
