<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialPartListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_part_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_submittion_id')  ;
            $table->string('part_name')->nullable();
            $table->string('example_part_number')->nullable() ;
            $table->string('vendor_name')->nullable();
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
        Schema::dropIfExists('special_part_lists');
    }
}
