<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
    	'name',
    	'post_id'
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'name', 'post_id');
    }
}
