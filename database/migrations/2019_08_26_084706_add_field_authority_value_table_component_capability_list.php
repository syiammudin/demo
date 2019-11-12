<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldAuthorityValueTableComponentCapabilityList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('component_capability_lists', function (Blueprint $table) {
          $table->string('authority_value')->after('authority')->nullable() ;
          $table->date('date_approve')->nullable() ;
          $table->string('status_of_application')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
