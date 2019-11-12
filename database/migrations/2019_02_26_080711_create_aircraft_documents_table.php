<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAircraftDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('document_code')->nullable() ;
            $table->string('type')->nullable() ;
            $table->text('description_document')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('ac_type')->nullable() ;
            $table->string('update')->nullable();
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
        Schema::dropIfExists('aircraft_documents');
    }
}
