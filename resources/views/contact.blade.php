@extends('layouts.main')

@push('head-scripts')
    <script src="https://api-maps.yandex.ru/v3/?apikey=f3852bfc-32f4-48aa-a3df-f6a8a57c764c&lang=ru_RU"></script>
    @vite(['resources/css/contact.css', 'resources/js/contact.js'])
@endpush

@section('content')
    <title>Контакты</title>
    <section class="cont-main-block">
        <div class="main-header">
            <img src="img/logo_about.png" alt="">
            <div class="header">КОНТАКТЫ</div>
        </div>
    </section>
    <section class="text-up-map">
        <div class="text-centred">
            <div class="first-text">ТЫ ЗАХОДИ,</div>
            <div class="second-text">ЕСЛИ ЧТО</div>
        </div>

    </section>
    <section class="ymap">
        <div class="map" id="app" role="presentation" aria-label="Карта: адрес ателье"></div>


        {{-- <div class="map"></div> --}}
        <div class="contact-info">
            <div>Телефон <br>
                +7-910-158-83-42 (Максим) </div>
            <div>Телефон <br>
                +7-920-766-88-88</div>
            <div>Почта <br>
                khodakovfh@mail.ru</div>
            <div>Адрес ателье <br>
                г. Новомосковск, ул. Трудовые Резервы, <br>33А</div>
            <div class="tg"><img src="img/tg.png" alt="">
                <div>
                    Khodakov Fashion House
                </div>
            </div>

        </div>


    </section>

    <section class="feedback-section">
        <div class="feedback-container">
            <div class="feedback-header">
                <div class="feedback-title">СДЕЛАТЬ ЗАКАЗ</div>
                <div class="feedback-subtitle">Мы свяжемся с вами в ближайшее время</div>
            </div>

            @if(session('success'))
                <div class="feedback-success" id="feedback-success">
                    <div class="feedback-success-icon">✓</div>
                    <div class="feedback-success-text">{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="feedback-form" id="contact-form">
                @csrf

                <div class="form-group">
                    <label for="contact-name" class="form-label">Ваше имя</label>
                    <input
                        type="text"
                        id="contact-name"
                        name="name"
                        class="form-input @error('name') form-input--error @enderror"
                        placeholder="Иван Петров"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact-contact" class="form-label">Телефон или e-mail</label>
                    <input
                        type="text"
                        id="contact-contact"
                        name="contact"
                        class="form-input @error('contact') form-input--error @enderror"
                        placeholder="+7-920-000-00-00 или email@mail.ru"
                        value="{{ old('contact') }}"
                        required
                    >
                    @error('contact')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact-message" class="form-label">Сообщение</label>
                    <textarea
                        id="contact-message"
                        name="message"
                        class="form-textarea @error('message') form-input--error @enderror"
                        placeholder="Опишите ваш заказ или задайте вопрос..."
                        rows="5"
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group--privacy">
                    <span class="privacy-notice">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="{{ route('privacy') }}" class="privacy-link">Политикой конфиденциальности</a>
                    </span>
                </div>

                <button type="submit" class="feedback-submit" id="contact-submit">ОТПРАВИТЬ ЗАКАЗ</button>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.feedback-success') || document.querySelector('.form-error')) {
                document.querySelector('.feedback-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
@endsection
