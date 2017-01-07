<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinvitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('email')->unique();
            $table->enum('status', ['pending', 'successful','canceled','expired']);
            $table->datetime('valid_till');
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
        Schema::drop('userinvitations');
    }
}
