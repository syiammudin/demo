<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldBecomePartNumberAllRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('engine_requests', function (Blueprint $table)
        {
            $table->renameColumn('no_document', 'part_number');
        });
        Schema::table('engine_requests', function (Blueprint $table)
        {
            $table->text('part_number')->nullable()->change();
        });


        Schema::table('special_requests', function (Blueprint $table)
        {
            $table->text('part_number')->nullable()->change();
            $table->dropColumn('no_document');
        });


        Schema::table('component_requests', function (Blueprint $table)
        {
            $table->text('part_number')->nullable()->change();
            $table->dropColumn('document_component_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
