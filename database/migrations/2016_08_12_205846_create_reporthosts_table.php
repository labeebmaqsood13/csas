<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporthostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporthosts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('host_end');
            $table->string('policy_name');
            $table->string('total_cves');
            $table->string('cpe');
            $table->string('os');
            $table->string('operating_system');
            $table->string('mac');
            $table->string('host_start');                                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reporthosts');
    }
}
