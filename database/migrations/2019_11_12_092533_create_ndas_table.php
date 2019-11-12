<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ndas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable() ;
            $table->string('buyer')->nullable() ;
            $table->string('seller')->nullable() ;
            $table->string('agent')->nullable() ;
            $table->string('effective_date')->nullable() ;
            $table->date('periode')->nullable() ;
            $table->text('investment')->nullable() ;
            $table->text('attachment')->nullable() ;
            $table->text('status')->nullable() ;
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
        Schema::dropIfExists('ndas');
    }
}
