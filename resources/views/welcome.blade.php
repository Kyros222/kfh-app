@vite(['resources/css/style.css', 'resources/js/contact.js'])
@extends('layouts.main')
@section('content')
    <title>Главная</title>
    <div class="main-block">
        <img class="floating-logo floating-logo--1" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--2" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--3" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--4" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--5" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--6" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--7" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--8" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--9" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--10" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--11" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--12" src="img/logo_about.png" alt="">
        <img class="floating-logo floating-logo--13" src="img/logo_about.png" alt="">
        <div class="background-text">
            <p class="background-header">KHODAKOV FASHION HOUSE</p>
            <p class="alternative-header">ВОПЛОТИ МЕЧТУ <br> В ЖИЗНЬ</p>
        </div>

    </div>
    <div class="sec-block">
        <div class="t-sec-block"></div>Не знаешь что выбрать?
        <div class="btns"><a class="consult-btn" href="/contact">ПРОКОНСУЛЬТИРОВАТЬСЯ <br> СО СПЕЦИАЛИСТОМ</a>
            <a href="https://t.me/khodakov_fashion_house_bot" class="consult-btn">ЗАКАЗАТЬ</a>
        </div>


    </div>
    <div class="preview-block">
        <span class="big-text">ВЫШИВКА</span>
        <span class="small-text">на все случаи жизни</span>
    </div>
    <section class="services">
        <div class="container">
            <div class="services-grid">

                <div class="service-card">
                    <img class="service-image" src="img/car.png" alt="Вышивка авто">
                    <div class="service-content">
                        <h3>Вышивка авто</h3>
                        <p>Тряпки, чехлы, аксессуары для автомобиля</p>
                    </div>
                </div>

                <div class="service-card">
                    <img class="service-image" src="img/text.png" alt="Вышивка надписи">
                    <div class="service-content">
                        <h3>Вышивка надписи</h3>
                        <p>Имена, цитаты, даты — любые надписи</p>
                    </div>
                </div>

                <div class="service-card">
                    <img class="service-image" src="img/logo.jpg" alt="Вышивка логотипов">
                    <div class="service-content">
                        <h3>Вышивка логотипов</h3>
                        <p>Для бизнеса, брендов и мерча</p>
                    </div>
                </div>

                <div class="service-card">
                    <img class="service-image" src="img/print.png" alt="Нанесение принта">
                    <div class="service-content">
                        <h3>Нанесение принта</h3>
                        <p>Цифровая печать на ткани любой сложности</p>
                    </div>
                </div>

                <div class="service-card">
                    <img class="service-image" src="img/par.png" alt="Парные вышивки">
                    <div class="service-content">
                        <h3>Парные вышивки</h3>
                        <p>Для пар, семей, друзей и команд</p>
                    </div>
                </div>

                <div class="service-card">
                    <img class="service-image" src="img/personal.jpg" alt="Индивидуальный заказ">
                    <div class="service-content">
                        <h3>Индивидуальный заказ</h3>
                        <p>Ваш уникальный дизайн — любые идеи</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="choice-block">
        <div class="t-sec-block"></div>Уже выбрал?
        <a href="https://t.me/khodakov_fashion_house_bot" class="consult-btn">ЗАКАЗАТЬ</a>
    </div>
@endsection
