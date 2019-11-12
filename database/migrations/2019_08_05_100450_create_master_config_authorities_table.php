<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterConfigAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_config_authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_config_id') ;
            $table->string('rating')->nullable() ;
            $table->string('value')->nullable() ;
            $table->string('status')->nullable() ;
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
        Schema::dropIfExists('master_config_authorities');
    }
}
