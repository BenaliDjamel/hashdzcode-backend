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
            $table->bigIncrements('id');
            $table->string('bio')->default('No bio found');
            $table->string('cover_profile')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('firstname');
            $table->string('followers')->default(0);
            $table->string('following')->default(0);
            $table->string('image_profile')->nullable();
            $table->string('github')->nullable();
            $table->string('lastname');
            $table->string('linkedin')->nullable();
            $table->string('location')->nullable();
            $table->string('password');
            $table->string('stackoverflow')->nullable();
            $table->string('tech_stack')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
