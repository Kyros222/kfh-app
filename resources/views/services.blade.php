@extends('layouts.main')

@push('head-scripts')
    @vite(['resources/css/services.css'])
@endpush

@section('content')
    <title>Услуги</title>
    <section class="cont-main-block">
        <div class="main-header">
            <img src="img/logo_about.png" alt="">
            <div class="header">УСЛУГИ
            </div>
        </div>
    </section>
    <section "usl-block">
        <div class="usl-cards">
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
            <div class="usl-card">
                <img src="img/spec.png" alt="">
                <div class="card-header">
                    РАЗРАБОТКА <br> СО СПЕЦИАЛИСТОМ
                </div>
                <div class="card-text">Разработаем ваш собственный мерч <br>
                    вместе</div>
            </div>
        </div>
    </section>
    <section class="price-block">
        <div class="price-card">
            <h2>РАЗРАБОТКА СО СПЕЦИАЛИСТОМ - от 4500 руб</h2>
            <h2>НАНЕСЕНИЕ ПРИНТА - от 4300 руб</h2>
            <h2>ОПТОВЫЕ ЗАКАЗЫ - ДОГОВОРНАЯ ЦЕНА</h2>
            <h2>ПОДПИСЬ ОДЕЖДЫ - 300 руб</h2>
            <h2>РАЗРАБОТКА ДИЗАЙНА - от 300 руб</h2>
            <h2>ПАРНЫЕ ВЫШИВКИ - от 7000 руб</h2>

            <hr>

            <p class="note">
                *ЕСЛИ У ВАС НЕТ ВЕКТОРНОЙ ВЕРСИИ ВАШЕГО ДИЗАЙНА/ПРИНТА,<br>
                ТО ВЫ МОЖЕТЕ ПРИОБРЕСТИ ЕГО У НАС
            </p>
        </div>
    </section>

    <section class="order-section">
        <div class="order-container">
            <div class="order-header">
                <div class="order-title">УЖЕ ВЫБРАЛ?</div>
                <div class="order-subtitle">Оставь заказ — мы свяжемся и обсудим детали</div>
            </div>

            @if(session('success'))
                <div class="feedback-success" id="services-success">
                    <div class="feedback-success-icon">✓</div>
                    <div class="feedback-success-text">{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('services.order') }}" method="POST" class="feedback-form" id="services-order-form">
                @csrf

                <div class="form-group">
                    <label for="order-name" class="form-label">Ваше имя</label>
                    <input
                        type="text"
                        id="order-name"
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
                    <label for="order-contact" class="form-label">Телефон или e-mail</label>
                    <input
                        type="text"
                        id="order-contact"
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
                    <label for="order-service" class="form-label">Тип услуги</label>
                    <select
                        id="order-service"
                        name="service_type"
                        class="form-input form-select"
                    >
                        <option value="">Выберите услугу</option>
                        <option value="Разработка со специалистом" {{ old('service_type') == 'Разработка со специалистом' ? 'selected' : '' }}>Разработка со специалистом</option>
                        <option value="Нанесение принта" {{ old('service_type') == 'Нанесение принта' ? 'selected' : '' }}>Нанесение принта</option>
                        <option value="Оптовый заказ" {{ old('service_type') == 'Оптовый заказ' ? 'selected' : '' }}>Оптовый заказ</option>
                        <option value="Подпись одежды" {{ old('service_type') == 'Подпись одежды' ? 'selected' : '' }}>Подпись одежды</option>
                        <option value="Разработка дизайна" {{ old('service_type') == 'Разработка дизайна' ? 'selected' : '' }}>Разработка дизайна</option>
                        <option value="Парные вышивки" {{ old('service_type') == 'Парные вышивки' ? 'selected' : '' }}>Парные вышивки</option>
                        <option value="Индивидуальный заказ" {{ old('service_type') == 'Индивидуальный заказ' ? 'selected' : '' }}>Индивидуальный заказ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="order-message" class="form-label">Сообщение</label>
                    <textarea
                        id="order-message"
                        name="message"
                        class="form-textarea @error('message') form-input--error @enderror"
                        placeholder="Опишите ваш заказ: вид изделия, количество, сроки..."
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

                <button type="submit" class="feedback-submit" id="services-submit">ОФОРМИТЬ ЗАКАЗ</button>
            </form>

            <div class="order-telegram">
                <span>Или напишите нам в</span>
                <a href="https://t.me/khodakov_fashion_house_bot" class="tg-link">
                    <img src="img/tg.png" alt="Telegram" class="tg-icon"> Telegram
                </a>
            </div>
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
