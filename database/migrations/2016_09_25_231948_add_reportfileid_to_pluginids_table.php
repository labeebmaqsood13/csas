<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportfileidToPluginidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pluginids', function (Blueprint $table) {
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
        Schema::table('pluginids', function (Blueprint $table) {
            $table->dropForeign('pluginids_reportfile_id_foreign');
        });
    }
}
