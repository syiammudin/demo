<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusOfAplicationTableMasterConfigAuthority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_config_authorities', function (Blueprint $table) {
              $table->string('status_of_application')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_config_authorities', function (Blueprint $table) {
            $table->string('status_of_application')->nullable();
        });
    }
}
