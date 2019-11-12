<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentPersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_personels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('name')->nullable() ;
            $table->string('id_number')->nullable() ;
            $table->string('nominate')->nullable() ;
            $table->string('training_certificate')->nullable() ;
            $table->string('staff_authorization')->nullable() ;
            $table->string('certificate_competence')->nullable() ;
            $table->string('personal_ability')->nullable() ;
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
        Schema::dropIfExists('component_personels');
    }
}
