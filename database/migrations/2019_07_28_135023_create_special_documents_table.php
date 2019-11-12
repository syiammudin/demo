<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('no_document')->nullable();
            $table->string('rev')->nullable() ;
            $table->date('rev_date')->nullable() ;
            $table->string('document_type')->nullable();
            $table->string('manual_status_confirmation')->nullable();
            $table->string('component_maintenance_manual')->nullable();
            $table->string('proposed_pd_sheet')->nullable();
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
        Schema::dropIfExists('special_documents');
    }
}
