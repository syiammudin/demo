<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentShopAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_shop_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('shop_maintenance')->nullable() ;
            $table->string('shop_maintenance_no')->nullable() ;
            $table->json('summary_of_maintenance')->nullable();
            $table->json('test_equipment')->nullable();
            $table->json('special_tool')->nullable();
            $table->json('capability_level')->nullable();
            $table->json('qualified_personel')->nullable();
            $table->json('material_planning')->nullable();
            $table->json('manhours_planning')->nullable();
            $table->json('consumable_material')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_shop_abilities');
    }
}
