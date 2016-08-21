<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyVulnerabilitiesDetailIpMac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vulnerabilities_detail_ip_mac', function (Blueprint $table) {
            $table->integer('vulnerability_detail_id')->unsigned();
            $table->foreign('vulnerability_detail_id')->references('id')->on('vulnerabilities_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vulnerabilities_detail_ip_mac', function (Blueprint $table) {
            $table->dropForeign('vulnerabilities_detail_ip_mac_vulnerability_detail_id_foreign');
        });
    }
}
