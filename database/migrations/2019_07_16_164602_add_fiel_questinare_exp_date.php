<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielQuestinareExpDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_capablity_list_details', function (Blueprint $table) {
            $table->date('questionnaire_exp_date')->after('other')->nullable() ;
            $table->json('document_evidence')->after('questionnaire_exp_date')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_capality_lists', function (Blueprint $table) {
            //
        });
    }
}
