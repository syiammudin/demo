<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldLimitationAndMaintenanceAreaValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->text('maintenance_area_value')->after('maintenance_area')->nullable() ;
            $table->text('limitation')->nullable() ;
            $table->string('ability')->nullable()->after('manager_statement') ;

            $table->dropColumn(['manager_statement', 'hangar_1', 'hangar_2','hangar_3','hangar_4','line_maintenance','other',
                                'ability_a_check','ability_c_check','ability_d_check','ability_other_maintenance']);
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
