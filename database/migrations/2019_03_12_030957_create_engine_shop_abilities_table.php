<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineShopAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_shop_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->text('shop_maintenance')->nullable();
            $table->text('number_ability')->nullable();
            $table->json('summary_of_maintenance')->nullable();
            $table->text('document_requirement')->nullable();
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
            $table->json('ablity')->nullable();
            $table->boolean('ability_inspection')->default(0);
            $table->boolean('ability_testing')->default(0);
            $table->boolean('ability_repair')->default(0);
            $table->boolean('ability_modification')->default(0);
            $table->boolean('ability_overhauled')->default(0);
            $table->json('consumable_material')->nullable(0);
            $table->text('shop_ability')->nullable();
            $table->text('part_name')->nullable();
            $table->text('part_number')->nullable();
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
        Schema::dropIfExists('engine_shop_abilities');
    }
}
