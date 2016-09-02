<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
         'title',
         'intro',
         'content',
         'slug',
         'toc',
         'progress',
         'epistemic',
     ];

    public function setPassword($password)
    {
        $this->update([
             'password' => password_hash($password, PASSWORD_DEFAULT),
         ]);
    }
}
