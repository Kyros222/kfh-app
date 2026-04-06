@extends('layouts.main')

@push('head-scripts')
    <script src="https://api-maps.yandex.ru/v3/?apikey=f3852bfc-32f4-48aa-a3df-f6a8a57c764c&lang=ru_RU"></script>
@endpush

@section('content')
    @vite(['resources/css/contact.css', 'resources/js/contact.js'])
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
@endsection
