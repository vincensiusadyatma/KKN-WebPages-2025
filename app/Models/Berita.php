<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
     protected $fillable = [
        'title',
        'category',
        'thumbnail_path',
        'content_path',
    ];

    public function authors()
{
    return $this->belongsToMany(User::class, 'berita_creators');
}

public function berita()
{
    return $this->belongsToMany(Berita::class, 'berita_creators');
}
}
