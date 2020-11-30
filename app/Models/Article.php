<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'author_id',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
