@extends('layouts.main')

@push('head-scripts')
    @vite(['resources/css/services.css'])
@endpush

@section('content')
    <title>Услуги</title>
    <section class="cont-main-block">
        <div class="main-header">
            <img src="img/logo_about.png" alt="">
            <div class="header">УСЛУГИ</div>
            <p class="services-intro">Выберите услугу — поможем с дизайном, производством и индивидуальными заказами</p>
        </div>
    </section>

    <section class="pricetable-section">
        <div class="pricetable-wrap">
            <div class="pricetable-header">
                <h2 class="pricetable-title">ПРАЙС-ЛИСТ</h2>
                <p class="pricetable-hint">Нажмите на строку, чтобы сразу перейти к заказу</p>
            </div>

            <div class="pricetable">
                <div class="pricetable__head">
                    <div class="pricetable__col pricetable__col--num">#</div>
                    <div class="pricetable__col pricetable__col--name">Услуга</div>
                    <div class="pricetable__col pricetable__col--desc">Описание</div>
                    <div class="pricetable__col pricetable__col--price">Цена</div>
                    <div class="pricetable__col pricetable__col--action"></div>
                </div>
                @foreach ($services as $i => $service)
                    <div
                        class="pricetable__row"
                        data-service-type="{{ $service->service_type }}"
                        role="button"
                        tabindex="0"
                        aria-label="Заказать: {{ $service->title }}"
                    >
                        <div class="pricetable__col pricetable__col--num">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="pricetable__col pricetable__col--name">
                            {{ $service->title }}
                        </div>

                        <div class="pricetable__col pricetable__col--desc">
                            {{ $service->text }}
                        </div>

                        <div class="pricetable__col pricetable__col--price">
                            {{ $service->price }}
                        </div>

                        <div class="pricetable__col pricetable__col--action">
                            <span class="pricetable__btn">Заказать</span>
                        </div>
                    </div>
                @endforeach
                <div class="pricetable__footer">
                    <span class="pricetable__note">
                        💡 Нет векторной версии вашего принта? Мы подготовим макет — обратитесь за разработкой дизайна.
                    </span>
                </div>
            </div>
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
                        @foreach ($services as $service)
                            <option
                                value="{{ $service->service_type }}"
                                {{ old('service_type') == $service->service_type ? 'selected' : '' }}
                            >{{ $service->title }}</option>
                        @endforeach
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
        document.addEventListener('DOMContentLoaded', function () {
            var rows = document.querySelectorAll('.pricetable__row');
            var select = document.getElementById('order-service');
            var form   = document.getElementById('services-order-form');

            if (document.querySelector('.feedback-success') || document.querySelector('.form-error')) {
                form.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            rows.forEach(function (row) {
                function activate() {
                    rows.forEach(function (r) { r.classList.remove('pricetable__row--active'); });
                    row.classList.add('pricetable__row--active');

                    if (select) {
                        select.value = row.dataset.serviceType;
                    }

                    form.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                row.addEventListener('click', activate);
                row.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        activate();
                    }
                });
            });
        });
    </script>
@endsection
