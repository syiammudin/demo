<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorManagementHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_management_id') ;
            $table->string('status')->nullable() ;
            $table->integer('user_id')->nullable() ;
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
        Schema::dropIfExists('vendor_management_histories');
    }
}
