<!DOCTYPE html>
<html lang="ru">

<head>
    @vite(['resources/css/style.css', 'resources/js/preloader.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/favicon32.png') }}" type="image/x-png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @stack('head-scripts')

</head>


<body>
    <nav class="nav">
        <div class="logo"><a href="/"><img src="{{ asset('img/loho.png') }}" alt=""></a>
        </div>
        <div class="links">

            <a class="{{ request()->is('about') ? 'active' : '' }}" href="/about">О нас</a>
            <a class="{{ request()->is('services') ? 'active' : '' }}" href="{{ route('services') }}">Услуги</a>
            <a class="{{ request()->is('contact') ? 'active' : '' }}" href="/contact">Контакты</a>
            <a class="{{ request()->is('blog') ? 'active' : '' }}" href="/blog">Блог</a>
        </div>
        <div class="number">+7-910-158-83-42</div>
        <div class="contact-btn"><img src="{{ asset('img/telega.png') }}" alt=""><button class="btn"><a
                    href="https://t.me/Khodakov_FashionHouse" class="text">СВЯЗАТЬСЯ С
                    НАМИ</a></button></div>
    </nav>



    <div id="preloader-1" class="preloader-1">
        <svg>
            <g>
                <path d="M 50,100 A 1,1 0 0 1 50,0" />
            </g>
            <g>
                <path d="M 50,75 A 1,1 0 0 0 50,-25" />
            </g>
            <defs>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#ffffffc7;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#7eb0ef;stop-opacity:1" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    @yield('content')
    <div class="faq">
        <div class="faq-block">
            <div class="faq-item">
                <div class="faq-question">
                    <span class="header">FAQ</span>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span class="text">Что такое мерч и зачем он нужен?</span>
                    <span class="faq-arrow">◀</span>
                </button>
                <div class="faq-answer">
                    <p>Здесь будет пояснение про мерч...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span class="text">Что лучше выбрать?</span>
                    <span class="faq-arrow">◀</span>
                </button>
                <div class="faq-answer">
                    <p>Здесь текст ответа...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span class="text">Вы делаете только вышивку или ещё и печать?</span>
                    <span class="faq-arrow">◀</span>
                </button>
                <div class="faq-answer">
                    <p>Ответ про вышивку и печать...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span class="text">Можно ли заказать один экземпляр для себя?</span>
                    <span class="faq-arrow">◀</span>
                </button>
                <div class="faq-answer">
                    <p>Ответ про единичный экземпляр...</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-site">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="/" class="footer-logo-link">
                        <img src="{{ asset('img/loho.png') }}" alt="Khodakov Fashion House" class="footer-logo">
                    </a>
                </div>

                <div class="footer-col">
                    <div class="footer-section-title">Контакты</div>
                    <div class="footer-item">
                        <span>Телефон:</span>
                        <a class="footer-link" href="tel:+79101588342">+7-910-158-83-42</a>
                    </div>
                    <div class="footer-item">
                        <span>Телефон для рекламы:</span>
                        <a class="footer-link" href="tel:+79207668888">+7-920-766-88-88</a>
                    </div>
                    <div class="footer-item">
                        <span>Почта:</span>
                        <a class="footer-link" href="mailto:khodakovfh@mail.ru">khodakovfh@mail.ru</a>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="footer-section-title">Адрес ателье:</div>
                    <div class="footer-item footer-item--block">
                        г. Новомосковск, ул. Трудовые Резервы, 33А
                    </div>
                    <div class="footer-item">
                        <span>ТГ:</span>
                        <span class="footer-text">Khodakov Fashion House</span>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="footer-section-title">Документы</div>
                    <a class="footer-policy-link" href="/privacy">Политика конфиденциальности</a>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© 2026 KHODAKOV FASHION HOUSE</span>
                <a href="/privacy" class="footer-bottom-link">Информация о конфиденциальности</a>
            </div>
        </div>
    </footer>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.faq-item');

        items.forEach(item => {
            const btn = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            if (!answer) return;

            btn.addEventListener('click', function() {

                item.classList.toggle('active');
            });
        });
    });
</script>
