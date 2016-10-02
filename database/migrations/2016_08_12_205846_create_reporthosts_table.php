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
            $table->ipAddress('host_ip')->nullable();
            $table->macAddress('mac')->nullable();
            $table->string('os', 15)->nullable();
            $table->string('system_type', 25)->nullable();
            $table->string('operating_system')->nullable();
            $table->string('cpe_1')->nullable();
            $table->string('host_end')->nullable();
            $table->integer('last_unauthenticated_results')->nullable();
            $table->boolean('credentialed_scan')->nullable();
            $table->string('policy_name')->nullable();
            $table->integer('total_cves')->nullable();
            $table->string('cpe')->nullable();
            $table->string('cpe_0')->nullable();
            $table->ipAddress('traceroute_hop_0')->nullable();
            $table->ipAddress('traceroute_hop_1')->nullable();
            $table->ipAddress('traceroute_hop_2')->nullable();
            $table->ipAddress('traceroute_hop_3')->nullable();
            $table->ipAddress('traceroute_hop_4')->nullable();
            $table->string('netbios_name')->nullable();
            $table->string('host_start')->nullable();
            $table->string('ssh_fingerprint')->nullable();
            $table->string('host_fqdn')->nullable();
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
        Schema::drop('reporthosts');
    }
}
