@vite(['resources/css/blog.css'])
@extends('layouts.main')
@section('content')
    <title>Блог</title>

    <div class="blog-page">
        <div class="blog-container">
            <div class="main-logo">
                <div class="logo-about"><img src="img/logo_about.png" alt=""></div>
                <div class="main-text">БЛОГ KHODAKOV</div>
            </div>

            <section class="posts-section">
                <div class="posts-grid">
                    @forelse ($posts as $post)
                        <a href="{{ route('post', $post) }}">
                            <article class="post-card">
                                @php
                                    $imageSrc = str_starts_with($post->image, 'http')
                                        ? $post->image
                                        : asset('storage/' . ltrim($post->image, '/'));
                                @endphp
                                <div class="post-meta">
                                    <span class="post-author">KHODAKOV TEAM</span>
                                    <span class="post-date">{{ $post->created_at->format('d.m.Y') }}</span>
                                </div>
                                <h3>{{ $post->title }}</h3>
                                <img src="{{ $imageSrc }}" alt="{{ $post->title }}">
                                <p class="post-excerpt">{{ $post->text }}</p>
                                <span class="post-ellipsis">Продолжение в посте →</span>
                            </article>
                        </a>
                    @empty
                        <article class="post-card">
                            <h3>Постов пока нет</h3>
                            <p>Добавьте записи через сидер или форму создания поста.</p>
                        </article>
                    @endforelse
                </div>
            </section>

            <section class="reviews-section">
                <h2>Отзывы</h2>
                <div class="reviews-grid">
                    <article class="review-card">
                        <h3>Анна, бренд одежды</h3>
                        <p>
                            "Работали над капсульной коллекцией худи с вышивкой. Все сделали точно в срок,
                            качество на уровне премиум, клиенты сразу заметили разницу."
                        </p>
                    </article>

                    <article class="review-card">
                        <h3>Дмитрий, автоклуб</h3>
                        <p>
                            "Заказывали партию мерча для клуба: футболки, патчи и кепки. Подсказали по материалам,
                            предложили удобные макеты и быстро запустили производство."
                        </p>
                    </article>

                    <article class="review-card">
                        <h3>Екатерина, event-агентство</h3>
                        <p>
                            "Нужно было срочно подготовить мерч к мероприятию. Команда включилась сразу:
                            все приехало вовремя и выглядело идеально."
                        </p>
                    </article>
                </div>
            </section>
        </div>
    </div>
@endsection
