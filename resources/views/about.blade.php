@vite(['resources/css/about.css'])
@extends('layouts.main')
@section('content')
    <title>О нас</title>
    <div class="main-logo">
        <div class="logo-about"><img src="img/logo_about.png" alt=""></div>
        <div class="main-text">МЕРЧ ДЛЯ ВСЕХ</div>
        <div class="vector"><img src="img/vector_about.png" alt=""></div>
    </div>
    <div class="about-block">
        <div class="who-block">
            <div class="header">#КТО МЫ?</div>
            <div class="small-text">Мы — молодая команда из Новомосковска, которая начинала с крохотной мастерской в обычной
                комнате частного дома. Там стоял один вышивальный станок, пара столов и большое желание делать вещи, которые
                люди будут носить с гордостью.</div>
        </div>
        <div class="bottom-row">
            <div class="who-block">
                <div class="header">#ИСТОКИ</div>
                <div class="small-text">Первые заказы были для друзей и местных команд: худи для небольших мероприятий,
                    футболки
                    для молодёжных проектов, патчи для своих. Со временем стало понятно, что это уже не просто хобби — люди
                    возвращались, рекомендовали нас другим, а наша «домашняя» мастерская перестала помещаться в рамки
                    семейного
                    хобби.</div>
            </div>
            <div class="who-block">
                <div class="header">#ЦЕННОСТИ</div>
                <div class="small-text">Мы не гонимся за количеством заказов в ущерб качеству.
                    Каждый мерч — это история.
                    Мы за открытость и прозрачность.
                    Мы выросли из небольших заказов и всегда остаёмся открытыми к локальным брендам.
                    Мы используем оборудование, но в основе — внимательные руки</div>
            </div>
        </div>

    </div>
    </div>
    <div class="parthners-block">
        <div class="part-header-block">
            <span class="part-header">ПАРТНЁРЫ</span>
            <span class="postscript">(тут могли бы быть вы)</span>
        </div>
        <div class="logos"><img src="img/parthners.png" alt="">
        </div>
    </div>
@endsection
