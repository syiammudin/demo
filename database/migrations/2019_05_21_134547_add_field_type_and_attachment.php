<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTypeAndAttachment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_documents', function (Blueprint $table) {
            $table->string('document_type')->nullable() ;
            $table->string('manual_status_confirmation')->nullable() ;
            $table->string('component_maintenance_manual')->nullable() ;
            $table->string('proposed_pd_sheet')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
