<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('author_id')
            ->constrained('users')
            ->onDelete('cascade');
            $table->longText('content');
            $table->string('cover_image')->nullable();
            $table->integer('comments_count')->nullable();
            $table->string('slug')->nullable();
            $table->string('title');
            $table->integer('likes_count')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
