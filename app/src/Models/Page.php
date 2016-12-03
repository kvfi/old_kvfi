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
         "created_at",
         'slug',
         'toc',
         'progress',
         'epistemic',
         'redirect_to',
     ];

    public function setPassword($password)
    {
        $this->update([
             'password' => password_hash($password, PASSWORD_DEFAULT),
         ]);
    }
}
