<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMostVulnerableAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('most_vulnerable_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('mac');
            $table->string('asset_type');
            $table->string('count');
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
        Schema::drop('most_vulnerable_assets');
    }
}
