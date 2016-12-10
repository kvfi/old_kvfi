<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
         'id',
         'slug',
         'title',
         'intro',
         'content',
         'created_at',
         'category',
         'progress',
         'epistemic',
         'tags',
         'toc',
         'difficulty',
         'extras'
     ];
}
