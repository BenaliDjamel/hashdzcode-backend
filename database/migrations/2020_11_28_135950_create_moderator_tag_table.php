<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeratorTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderator_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('moderator_id')
            ->constrained('users')
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
        Schema::dropIfExists('moderator_tag');
    }
}
