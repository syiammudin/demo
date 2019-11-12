<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInTbAircraftMaterialDocumentAndTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_documents', function (Blueprint $table) {
            $table->string('effective_code')->nullable() ;
        });
        Schema::table('aircraft_materials', function (Blueprint $table) {
            $table->string('camp_number')->nullable() ;
            $table->string('jobcard_number')->nullable() ;
            $table->string('title')->nullable() ;
            $table->string('mpd_number')->nullable() ;
            $table->string('references')->nullable() ;
            $table->string('interval')->nullable() ;
            $table->string('qty')->nullable() ;
        });
        Schema::table('aircraft_tool_equipments', function (Blueprint $table) {
            $table->string('camp_number')->nullable() ;
            $table->string('jobcard_number')->nullable() ;
            $table->string('title')->nullable() ;
            $table->string('mpd_number')->nullable() ;
            $table->string('references')->nullable() ;
            $table->string('interval')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_aircraft_material_document_and_tools', function (Blueprint $table) {
            //
        });
    }
}
