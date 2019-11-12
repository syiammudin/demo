<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInSpecialPersonel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_personels', function (Blueprint $table) {
          $table->string('nominate')->nullable();
          $table->string('training_certificate')->nullable();
          $table->string('personal_ability')->nullable();
          $table->string('certificate_competence')->nullable();
          $table->string('staff_authorization')->nullable();
          $table->string('level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_personels', function (Blueprint $table) {
            //
        });
    }
}
