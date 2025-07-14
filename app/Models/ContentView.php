<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentView extends Model
{
     protected $fillable = ['content_type', 'content_id', 'views'];

      public $timestamps = true;

       protected $casts = [
        'views' => 'integer',
        'content_id' => 'integer',
    ];
}
