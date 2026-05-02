@vite(['resources/css/post.css'])
@extends('layouts.main')

@section('content')
    <title>{{ $post->title }}</title>
    <article class="post-container">
        <div class="post-meta">
            {{ $post->created_at->format('d F Y') }}
        </div>


        <h1 class="post-title">{{ $post->title }}</h1>

        @php
            $imageSrc = str_starts_with($post->image, 'http')
                ? $post->image
                : asset('storage/' . ltrim($post->image, '/'));
        @endphp
        <div class="post-image-wrapper">
            <img src="{{ $imageSrc }}" alt="{{ $post->title }}">
        </div>

        <div class="post-content">
            {!! nl2br(e($post->text)) !!}
        </div>

        <a href="{{ route('blog') }}" class="back-link">← Назад в блог</a>
    </article>
@endsection
