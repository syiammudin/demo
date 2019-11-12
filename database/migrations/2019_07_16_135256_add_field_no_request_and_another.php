<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldNoRequestAndAnother extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_managements', function (Blueprint $table) {
            $table->string('request_number')->after('id')->nullable() ;
            $table->string('maint_fn')->nullable();
            $table->date('questionnaire_exp_date')->nullable() ;
            $table->text('product_service')->nullable() ;
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
