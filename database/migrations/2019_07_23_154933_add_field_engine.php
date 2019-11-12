<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldEngine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_types', function (Blueprint $table) {
            $table->string('engine')->nullable() ;
        });

        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->string('engine')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircraft_types', function (Blueprint $table) {
            //
        });
    }
}
