<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldAttachmentEginePersonels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engine_personels', function (Blueprint $table) {
          $table->string('nominate')->nullable();
          $table->string('training_certificate')->nullable();
          $table->string('personal_ability')->nullable();
          $table->string('certificate_competence')->nullable();
          $table->string('staff_authorization')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engine_personels', function (Blueprint $table) {
            //
        });
    }
}
