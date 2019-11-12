<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialShopAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_shop_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id');
            $table->string('shop_maintenance')->nullable() ;
            $table->string('shop_ability_number')->nullable() ;
            $table->json('summary_of_maintenance')->nullable() ;
            $table->text('document_required')->nullable();
            $table->text('test_equipment_part_number')->nullable();
            $table->text('test_equipment_part_name')->nullable();
            $table->text('special_tool_part_number')->nullable();
            $table->text('special_tool_part_name')->nullable();
            $table->text('remark')->nullable();
            $table->text('manufacture_documentation_drawing')->nullable();
            $table->text('inspection')->nullable();
            $table->text('tool_equipment')->nullable();
            $table->text('special_work')->nullable();
            $table->text('particular')->nullable();
            $table->text('available_qualified')->nullable();
            $table->boolean('ability_inspection')->nullable();
            $table->boolean('ability_testing')->nullable();
            $table->boolean('ability_modification')->nullable();
            $table->boolean('ability_repair')->nullable();
            $table->boolean('ability_overhauled')->nullable();
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
        Schema::dropIfExists('special_shop_abilities');
    }
}
