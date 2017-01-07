<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phase_id')->unsigned();
            $table->foreign('phase_id')->references('id')->on('phases');
            
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

           
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
        Schema::table('sops', function (Blueprint $table) {
            $table->dropForeign('sops_phase_id_foreign');
        });

        Schema::table('sops', function (Blueprint $table) {
            $table->dropForeign('sops_project_id_foreign');
        });

        Schema::drop('sops');
    }
}