<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameColumnComponentManhoursPlannings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_manhours_plannings', function (Blueprint $table) {
            $table->renameColumn('part_number', 'task_name')->nullable();
            $table->renameColumn('part_description', 'man_hour')->nullable();
            $table->renameColumn('qty', 'man_power')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component_manhours_plannings', function (Blueprint $table) {
            //
        });
    }
}
