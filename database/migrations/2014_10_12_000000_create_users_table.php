<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->index();
            $table->string('email')->unique()->index();
            $table->string('facebook_token')->index();
            $table->string('google_token')->index();
            $table->string('hashed_password')->index();
            $table->boolean('account_enabled')->index();

            $table->string('signup_url');
            $table->string('signup_referer_url');
            $table->string('signup_device');
            $table->string('signup_ip');

            $table->integer('credit')->default(0);
            $table->timestamp('account_creation');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
