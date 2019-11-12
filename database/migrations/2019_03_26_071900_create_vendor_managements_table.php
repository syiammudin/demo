<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->string('dept')->nullable();
            $table->string('phone')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('vendor_address')->nullable();
            $table->string('vendor_city')->nullable();
            $table->string('vendor_state')->nullable();
            $table->string('vendor_zip_code')->nullable();
            $table->string('vendor_phone')->nullable();
            $table->string('vendor_fax')->nullable();
            $table->string('parent_company')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('supplier_code')->nullable();
            $table->string('aplication_drawing')->nullable();
            $table->string('item_proposed')->nullable();
            $table->string('type_supplier')->nullable();
            $table->string('type_bussines')->nullable();
            $table->string('age_organization')->nullable();
            $table->string('total_employee')->nullable();
            $table->string('total_supervisors')->nullable();
            $table->string('total_inspectors')->nullable();
            $table->string('total_personel')->nullable();
            $table->json('list_name_aproval')->nullable();
            $table->json('list_customers')->nullable();
            $table->json('list_curent_capability')->nullable();
            $table->string('representative_indonesia')->nullable();
            $table->json('document_evidence')->nullable();
            $table->date('date_audit')->nullable();
            $table->string('status')->default('0');
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
        Schema::dropIfExists('vendor_managements');
    }
}
