<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorCapablityListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_capablity_list_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('capability_list_id') ;
            $table->string('type_supplier')->nullable() ;
            $table->string('supplier_name')->nullable() ;
            $table->string('vendor_code')->nullable() ;
            $table->text('address')->nullable() ;
            $table->string('email')->nullable() ;
            $table->date('last_update')->nullable() ;
            $table->text('maint_fn')->nullable() ;
            $table->text('product_service')->nullable() ;
            $table->text('remark')->nullable() ;
            $table->string('dgca')->nullable() ;
            $table->string('faa')->nullable() ;
            $table->string('easa')->nullable() ;
            $table->string('asa')->nullable() ;
            $table->string('iso')->nullable() ;
            $table->string('nc')->nullable() ;
            $table->string('kan')->nullable() ;
            $table->string('other')->nullable() ;
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
        Schema::dropIfExists('vendor_capablity_list_details');
    }
}
