<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManagerStatementChoised extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->boolean('facilities')->nullable() ;
            $table->boolean('certifying_staff')->nullable() ;
            $table->boolean('approved_data')->nullable() ;
            $table->boolean('qualified_personel')->nullable() ;
            $table->boolean('special_tools')->nullable() ;
            $table->boolean('consumable')->nullable() ;
            $table->boolean('other_main_value')->nullable() ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircraft_request', function (Blueprint $table) {
            //
        });
    }
}
