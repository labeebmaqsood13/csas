<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportitems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('port');
            $table->string('svc_name');
            $table->string('protocol');
            $table->string('severity');
            $table->string('plugin_id');
            $table->string('plugin_name');
            $table->string('plugin_family');
            $table->string('description');
            $table->string('risk_factor');
            $table->string('solution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reportitems');
    }
}
