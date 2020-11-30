<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowerTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follower_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('tag_id')
            ->constrained()
            ->onDelete('cascade');
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
        Schema::dropIfExists('follower_tag');
    }
}
