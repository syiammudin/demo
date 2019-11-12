<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentEquivalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_equivalents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('component_test_equipment_id') ;
            $table->string('equivalent_number')->nullable() ;
            $table->json('tool_category')->nullable() ;
            $table->date('original_issued')->nullable() ;
            $table->string('rev_no')->nullable() ;
            $table->date('issued')->nullable() ;
            $table->string('distribution')->nullable();
            $table->string('efectifity')->nullable() ;
            $table->string('doc_no')->nullable();
            $table->string('reason_issuance')->nullable();
            $table->string('effect_maintenance_procedure')->nullable();
            $table->json('ability')->nullable();
            $table->string('reason_of_revision')->nullable();
            $table->json('recomended_tool')->nullable();
            $table->json('alternate_tool')->nullable();
            $table->json('maintenance_task')->nullable();
            $table->json('recomended')->nullable();
            $table->json('alternate')->nullable();
            $table->json('related_maintenance')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('component_equivalents');
    }
}
