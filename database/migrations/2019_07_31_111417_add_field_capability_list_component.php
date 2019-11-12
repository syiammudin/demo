<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCapabilityListComponent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_capability_lists', function (Blueprint $table) {
          $table->string('technical_data')->nullable();
          $table->string('major_equipment')->nullable();
          $table->string('customer')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component_capability_lists', function (Blueprint $table) {
            //
        });
    }
}
