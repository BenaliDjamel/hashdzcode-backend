<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void {
        parent::setUp();
        $this->user =  User::factory()->create();
          Sanctum::actingAs(
            $this->user,
            ['*']
        ); 
    }

    public function test_authenticated_user_can_add_article() {
        $this->withoutExceptionHandling();
        $this->post('/api/articles', $this->data()); 
        $this->assertCount(1, Article::all());
    }

    public function test_authenticated_user_can_retrieve_article() {
        $this->withoutExceptionHandling();
        $article = Article::factory()->create();
        $response = $this->get("/api/articles/$article->slug");
        $response->assertOk($response);
         $response->assertJson([
             "author_id"=>$article->author_id,
            "content" => $article->content,
            "title" =>$article->title,
            "slug"=> $article->slug 
         ]); 
    }

    public function test_author_can_retrieve_his_articles() {
        $this->withoutExceptionHandling();
       $article =  Article::factory()->create(['author_id' => $this->user->id]);
        $response = $this->get('/api/articles');
        $response->assertJsonCount(1);
        $response->assertJson([['id' => $article->id] ]);
    }

    public function test_articles_can_retrieved_for_user() {
        $this->withoutExceptionHandling();
        $article =  Article::factory()->create(['author_id' => $this->user->id]);
        $response = $this->get("/api/users/{$this->user->id}/articles");
        $response->assertJsonCount(1);
        $response->assertJson([['id' => $article->id] ]);
    }

    public function test_get_author_of_article() {
        $this->withoutExceptionHandling();
        $article =  Article::factory()->create(['author_id' => $this->user->id]);
        $response = $this->get("/api/articles/{$article->id}/user");
        $response->assertJson(['id' => $this->user->id]);
    }

    public function test_authenticated_user_can_update_article() {
        $this->withoutExceptionHandling();
        $article = Article::factory()->create();
        $response = $this->patch("/api/articles/$article->id", $this->data());
        $article =  $article->fresh();
        $this->assertEquals('javascript the good part', $article->title);
        $this->assertEquals('a just test', $article->content);
    }

    public function test_authenticated_user_can_delete_article() {
        $this->withoutExceptionHandling();
        $article = Article::factory()->create();
        $response = $this->delete("/api/articles/$article->id");
        $this->assertCount(0, Article::all());
    }

    public function test_fields_are_required() {
        collect(['title','content' ])->each(function($field) {
            $response =  $this->postJson('/api/articles', array_merge($this->data(), [$field => ''])); 
            $response->assertStatus(422);
            $this->assertCount(0, Article::all());
        });
    }

    

    private function data() {
        return  [
            'content' => "a just test",
            "title" =>"javascript the good part",
        ];
    }


}
