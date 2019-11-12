<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndEditFieldTableMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engine_consumable_materials', function (Blueprint $table) {
            $table->renameColumn('code_number','part_number')->nullable() ;
            $table->string('remark')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engine_consumable_materials', function (Blueprint $table) {
            //
        });
    }
}
