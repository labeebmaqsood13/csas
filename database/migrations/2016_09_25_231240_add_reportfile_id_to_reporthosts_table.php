<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportfileIdToReporthostsTable extends Migration
{
    public function up()
    {
        Schema::table('reporthosts', function (Blueprint $table) {
            $table->integer('reportfile_id')->unsigned();
            $table->foreign('reportfile_id')->references('id')->on('reportfiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporthosts', function (Blueprint $table) {
            $table->dropForeign('reporthosts_reportfile_id_foreign');
        });
    }

}
