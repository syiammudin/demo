<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSubmittionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_submittions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id') ;
            $table->integer('master_request_id') ;
            $table->string('status')->default('0') ;
            $table->string('aproval')->nullable() ;
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
        Schema::dropIfExists('request_submittions');
    }
}
