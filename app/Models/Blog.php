<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // app/Models/Blog.php
protected $fillable = [
    'title',
    'thumbnail_path',
    'content_path',
];

public function authors()
{
    return $this->belongsToMany(User::class, 'blog_creators');
}


}
