<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentResubmitVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_resubmit_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_management_id') ;
            $table->string('attachment')->nullable() ;
            $table->text('note')->nullable() ;
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
        Schema::dropIfExists('attachment_resubmit_vendors');
    }
}
