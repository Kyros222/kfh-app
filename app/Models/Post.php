<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'text',
    ];

    protected static function booted(): void
{
    static::creating(function (Post $post) {
        $base = Str::slug($post->title, '-', 'ru');
        $slug = $base;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $post->slug = $slug;
    });
}
public function getRouteKeyName(): string
{
    return 'slug';
}
}
