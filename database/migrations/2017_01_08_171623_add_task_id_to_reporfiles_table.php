<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskIdToReporfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reportfiles', function (Blueprint $table) {
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportfiles', function (Blueprint $table) {
            $table->dropForeign('reportfiles_task_id_foreign');
        });
    }
    
}





