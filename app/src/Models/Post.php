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
         'created_at',
         'category',
         'progress',
         'epistemic',
         'type',
         'tags',
         'toc',
         'difficulty',
         'extras'
     ];
}
