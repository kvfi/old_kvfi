<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpistemicState extends Model
{
    protected $table = 'epistemic_states';

    protected $fillable = [
        'id',
        'title'
     ];

    
}
