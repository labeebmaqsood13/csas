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
            $table->integer('port');
            $table->string('svc_name', 15);
            $table->string('protocol', 10);
            $table->integer('severity');
            $table->integer('plugin_id');
            $table->string('plugin_name');
            $table->string('plugin_family');
            $table->string('description');
            $table->string('risk_factor');
            $table->string('solution');
            $table->string('plugin_output')->nullable();
            $table->string('synopsis');
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
        Schema::drop('reportitems');
    }
}
