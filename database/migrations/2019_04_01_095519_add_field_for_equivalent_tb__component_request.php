<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldForEquivalentTbComponentRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_requests', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('component_requests', function (Blueprint $table) {
            //
        });
    }
}
