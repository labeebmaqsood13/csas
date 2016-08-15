<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHostpropertyidToReportitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reportitems', function (Blueprint $table) {
            $table->integer('reporthost_id')->unsigned();
            $table->foreign('reporthost_id')->references('id')->on('reporthosts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportitems', function (Blueprint $table) {
            $table->dropForeign('reportitems_reporthost_id_foreign');
        });
    }
}
