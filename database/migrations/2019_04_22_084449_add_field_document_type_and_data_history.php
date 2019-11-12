<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDocumentTypeAndDataHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_requests', function (Blueprint $table) {
            $table->string('document_type')->nullable() ;
        });
        Schema::table('request_histories', function (Blueprint $table) {
            $table->json('data')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component_requests', function (Blueprint $table) {
            //
        });
    }
}
