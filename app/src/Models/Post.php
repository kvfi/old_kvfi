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
         'category',
         'progress',
         'epistemic',
         'tags',
         'toc',
         'extras',
     ];
}
