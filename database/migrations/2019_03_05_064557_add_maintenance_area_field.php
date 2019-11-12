<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaintenanceAreaField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->boolean('hangar_1')->default(0) ;
            $table->boolean('hangar_2')->default(0) ;
            $table->boolean('hangar_3')->default(0) ;
            $table->boolean('hangar_4')->default(0) ;
            $table->string('line_maintenance')->nullable() ;
            $table->string('other')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            //
        });
    }
}
