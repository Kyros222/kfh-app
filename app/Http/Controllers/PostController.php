<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
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

    public function store(StorePostRequest $request): RedirectResponse
    {
        $postData = $request->validated();
        $postData['image'] = $request->file('image')->store('posts', 'public');

        Post::query()->create($postData);

        return redirect()
            ->route('blog')
            ->with('success', 'Пост успешно добавлен.');
    }

    public function post(Post $post): View
    {
        return view("post", compact('post'));
    }
}
