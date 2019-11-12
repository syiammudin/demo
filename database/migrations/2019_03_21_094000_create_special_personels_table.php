<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialPersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_personels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('name')->nullable() ;
            $table->string('id_number')->nullable() ;
            $table->text('job_title')->nullable();
            $table->string('auth_no_stamp_holder')->nullable();
            $table->string('unit')->nullable();
            $table->string('scope_competency')->nullable();
            $table->string('skill')->nullable(); 
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
        Schema::dropIfExists('special_personels');
    }
}
