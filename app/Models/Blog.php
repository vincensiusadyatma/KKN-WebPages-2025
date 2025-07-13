<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // app/Models/Blog.php
protected $fillable = [
    'title',
    'thumbnail_path',
    'category',
    'content_path',
];

public function authors()
{
    return $this->belongsToMany(User::class, 'blog_creators');
}
   // Jika hanya satu author per blog (ambil yang pertama)
    public function creator()
    {
        return $this->authors()->first();
    }

}
