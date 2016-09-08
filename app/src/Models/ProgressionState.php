<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressionState extends Model
{
    protected $table = 'progression_states';

    protected $fillable = [
        'id',
        'title'
     ];

     public function addPost()
     {
         UserAdvertisementView::create(array(
    'user_id'=> Auth::user()->id,
    'add_id'=> $requestData['product_id'],
    'total_view'=>1
    ));
     }

    
}
