<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielDecisionAndScoreInReqSubmittions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_submittions', function (Blueprint $table) {
            $table->json('decision')->nullable() ;
            $table->string('score')->nullable() ;
        });

        Schema::table('aircraft_requests', function (Blueprint $table) {
            $table->text('special_work')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_submittions', function (Blueprint $table) {
            //
        });
    }
}
