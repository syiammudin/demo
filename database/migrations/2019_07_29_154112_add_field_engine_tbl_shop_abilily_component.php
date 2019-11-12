<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldEngineTblShopAbililyComponent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_shop_abilities', function (Blueprint $table) {
          $table->text('manufacture_documentation_drawing')->nullable();
          $table->text('inspection')->nullable();
          $table->text('tool_equipment')->nullable();
          $table->text('special_work')->nullable();
          $table->text('particular')->nullable();
          $table->text('available_qualified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component_shop_ablities', function (Blueprint $table) {
            //
        });
    }
}
