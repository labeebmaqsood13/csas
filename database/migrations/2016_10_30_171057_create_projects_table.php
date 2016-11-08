<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->ipAddress('subnet_from');
            $table->ipAddress('subnet_to');
            
            $table->string('location');
            $table->date('due_date');
            $table->string('description');
            $table->enum('status', ['in progress', 'finished']);
            
            $table->enum('user_type',['manager','not_manager']);
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
        Schema::drop('projects');
    }
}
