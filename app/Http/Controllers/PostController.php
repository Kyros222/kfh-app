<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->latest()
            ->get();

        return view('blog', compact('posts'));
    }

    public function post(Post $post): View
    {
        return view('post', compact('post'));
    }
}
