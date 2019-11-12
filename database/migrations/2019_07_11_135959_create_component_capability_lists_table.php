<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentCapabilityListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_capability_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('capability_list_id')->nullable() ;
            $table->string('part_number')->nullable() ;
            $table->string('component_name')->nullable() ;
            $table->string('vendor_manufacture')->nullable() ;
            $table->string('ata_chapter')->nullable() ;
            $table->json('capability_level')->nullable() ;
            $table->string('workshop')->nullable() ;
            $table->string('aircraft_type')->nullable() ;
            $table->json('for_rating')->nullable() ;
            $table->string('date_approval')->nullable() ;
            $table->string('authority')->nullable() ;
            $table->string('status')->nullable() ;
            $table->string('request_number')->nullable() ;
            $table->string('no_shop_ability')->nullable() ;
            $table->string('component_type')->nullable() ;
            $table->string('request_type')->nullable() ;
            $table->json('document')->nullable() ;
            $table->json('manhours_planning')->nullable() ;
            $table->json('personel')->nullable() ;
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
        Schema::dropIfExists('component_capability_lists');
    }
}
