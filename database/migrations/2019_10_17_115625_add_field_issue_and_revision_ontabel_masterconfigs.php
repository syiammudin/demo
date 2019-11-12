<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldIssueAndRevisionOntabelMasterconfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_config_authorities', function (Blueprint $table) {
            $table->string('issue')->nullable() ;
            $table->string('revision')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_configs', function (Blueprint $table) {
            //
        });
    }
}
