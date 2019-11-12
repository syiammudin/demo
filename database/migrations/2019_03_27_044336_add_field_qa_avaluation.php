<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldQaAvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_managements', function (Blueprint $table) {
            $table->string('evaluation_organization')->default('0') ;
            $table->string('evaluation_quality_assurance')->default('0') ;
            $table->string('evaluation_qa_system')->default('0') ;
            $table->string('evaluation_indicate_supply')->default('0') ;
            $table->string('evaluation_part_inspection')->default('0') ;
            $table->string('evaluation_maintain_quality')->default('0') ;
            $table->string('evaluation_program_recertify')->default('0') ;
            $table->string('evaluation_control_policies')->default('0') ;
            $table->string('evaluation_trace_ability')->default('0') ;
            $table->string('evaluation_for_usa_only')->default('0') ;
            $table->string('evaluation_provide')->default('0') ;
            $table->string('evaluation_implement_sms')->default('0') ;
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_managements', function (Blueprint $table) {
            //
        });
    }
}
