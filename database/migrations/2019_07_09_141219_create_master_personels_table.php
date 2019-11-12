<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_personels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nopeg')->nullable() ;
            $table->string('nama')->nullable() ;
            $table->string('jabatan')->nullable() ;
            $table->string('unit')->nullable() ;
            $table->string('email')->nullable() ;
            $table->string('tempat_lahir')->nullable() ;
            $table->string('tanggal_lahir')->nullable() ;
            $table->string('tanggal_masuk')->nullable() ;
            $table->string('passduedate')->nullable() ;
            $table->string('status')->nullable() ;
            $table->json('amel')->nullable() ;
            $table->json('gmf_auth')->nullable() ;
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
        Schema::dropIfExists('master_personels');
    }
}
