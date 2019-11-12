<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbAuthPersonelGmfScopeAmelScope extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aircraft_authorized_personels', function (Blueprint $table) {
            $table->json('amel_scope')->nullable() ;
            $table->json('gmf_scope')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aircraft_authorized_personel', function (Blueprint $table) {
            //
        });
    }
}
