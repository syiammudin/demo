<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidTbMainareaPartnumUnitofmeaAricrafttype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_areas', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });

        Schema::table('part_numbers', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });


        Schema::table('aircraft_types', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });

        Schema::table('unit_of_measures', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
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
