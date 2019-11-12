<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapabilityListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capability_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_capability_list')->nullable();
            $table->string('type_supplier')->nullable() ;
            $table->string('authority')->nullable() ;
            $table->string('revision')->nullable();
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('capability_lists');
    }
}
