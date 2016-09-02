<?php

namespace App\Controllers;

use App\Models\User;

class EditorController extends Controller
{
    public function index($request, $response)
    {
        $post = User::where('email', 'ouafikhalid@gmail.com')->first();

        echo $post->email;
    }
}
