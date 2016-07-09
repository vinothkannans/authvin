<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOAuthProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('provider', ['google', 'twitter', 'google', 'linkedin', 'github', 'bitbucket']);
            $table->string('id');
            $table->string('token');
            $table->string('token_secret')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('expires_in')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->primary(['provider', 'id']);
            $table->unique(['user_id', 'provider']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oauth_profiles');
    }
}
