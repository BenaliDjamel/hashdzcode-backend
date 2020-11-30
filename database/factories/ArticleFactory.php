<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title  = $this->faker->title;
        return [
            'author_id' => User::factory(),
            'title' => $title,
            'content' => $this->faker->paragraph,
            'slug' => Str::slug($title, '-')
        ];
    }
}
