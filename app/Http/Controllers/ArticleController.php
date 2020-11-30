<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function index() {
        return auth()->user()->articles;
    }

    public function articlesForUser(User $user) {
        return $user->articles;
    }

    public function authorOfArticle(Article $article) {
       
        return $article->user;
    }
   
    
    public function store(ArticleRequest $request) {
         Article::create([
            "author_id"=>auth()->id(),
            "content" => $request->content,
            "title" =>$request->title,
            "slug"=> Str::slug($request->title, '-')
        ]); 
    }

    public function show(String $slug) {
        $article = Article::whereSlug($slug)->firstOrFail();
        return $article;
    }

    public function update(ArticleRequest $request, Article $article) {
       
        $article->update([
            "content" => $request->content,
            "title" =>$request->title,
            "slug"=> Str::slug($request->title, '-')
        ]);
        return $article;
    }

    public function delete(Article $article) {
       
        $article->delete();
        return $article;
    }
}
