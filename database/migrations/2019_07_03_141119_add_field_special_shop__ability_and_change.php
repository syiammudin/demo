<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSpecialShopAbilityAndChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_shop_abilities', function (Blueprint $table) {
            $table->string('ndt_method')->nullable() ;
            $table->string('reference')->nullable() ;
            $table->text('special_facility')->nullable() ;
            $table->json('qualified_personel')->nullable() ;
            $table->json('equipment_tools')->nullable() ;
            $table->string('ability')->nullable() ;

        });
        Schema::table('special_requests', function (Blueprint $table) {
            $table->json('aproval_request_carry_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_shop_abilities', function (Blueprint $table) {
            //
        });
    }
}
