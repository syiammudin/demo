<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftAuthorizedPersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft_authorized_personels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('name')->nullable();
            $table->string('personal_number')->nullable() ;
            $table->string('sta')->nullable();
            $table->string('skill')->nullable() ;
            $table->string('amel_no')->nullable();
            $table->date('ex_date_ame')->nullable();
            $table->string('gmf_auth_number')->nullable();
            $table->date('ex_date_company')->nullable();
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
        Schema::dropIfExists('aircraft_authorized_personels');
    }
}
