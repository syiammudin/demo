<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id') ;
            $table->string('manual_status_confirmation')->nullable();
            $table->string('component_maintenance_manual')->nullable();
            $table->string('proposed_pd_sheet')->nullable();
            $table->string('vendor_statement')->nullable();
            $table->string('simple_component_evaluation')->nullable();
            $table->string('component_similarity')->nullable();
            $table->string('maintenance_record')->nullable();
            $table->string('sample_component_relase')->nullable();
            $table->string('other')->nullable();
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
        Schema::dropIfExists('component_attachments');
    }
}
