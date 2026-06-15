# KFH App — Khodakov Fashion House

Сайт ателье **Khodakov Fashion House**: витрина услуг, блог, формы заказов и админ-панель [MoonShine](https://moonshine-laravel.com) для управления контентом и заявками.

**Стек:** Laravel 13 · PHP 8.3+ · MySQL 8 · Vite · Tailwind CSS 4 · MoonShine 2

---

## Содержание

- [Требования](#требования)
- [Локальная разработка](#локальная-разработка)
- [Развёртывание через Docker (рекомендуется)](#развёртывание-через-docker-рекомендуется)
- [Развёртывание без Docker](#развёртывание-без-docker)
- [Админ-панель MoonShine](#админ-панель-moonshine)
- [Проверка работоспособности](#проверка-работоспособности)
- [Структура Docker-образа](#структура-docker-образа)
- [Переменные окружения](#переменные-окружения)
- [Решение проблем](#решение-проблем)

---

## Требования

### Локальная разработка

| Компонент | Версия |
|-----------|--------|
| PHP | 8.3+ (расширения: pdo_mysql, mbstring, intl, gd, zip, exif) |
| Composer | 2.x |
| Node.js | 20.x |
| MySQL | 8.0 |

### Production (Docker)

| Компонент | Версия |
|-----------|--------|
| Docker | 24+ |
| Docker Compose | v2 |

---

## Локальная разработка

```bash
# 1. Клонировать репозиторий и перейти в каталог
cd kfh-app

# 2. Установить зависимости
composer install
npm install

# 3. Настроить окружение
cp .env.example .env
php artisan key:generate

# 4. Настроить БД в .env (DB_*), затем:
php artisan migrate

# 5. Симлинк для загрузок (изображения постов)
php artisan storage:link

# 6. Собрать фронтенд
npm run build
# или для hot-reload:
npm run dev

# 7. Запустить сервер (или composer run dev — сервер + очередь + vite)
php artisan serve
```

Сайт: `http://localhost:8000`  
Health-check: `http://localhost:8000/up`

---

## Развёртывание через Docker (рекомендуется)

Docker-образ включает **Nginx**, **PHP-FPM**, **Supervisor** (очередь `queue:work`) и собранные Vite-ассеты. База данных — отдельный контейнер MySQL.

### 1. Подготовка сервера

```bash
# Установить Docker и Docker Compose (Ubuntu/Debian — пример)
sudo apt update && sudo apt install -y docker.io docker-compose-v2
sudo usermod -aG docker $USER
# Перелогиниться, чтобы группа docker применилась
```

### 2. Получить код на сервер

```bash
git clone <URL-репозитория> kfh-app
cd kfh-app
```

### 3. Создать файл `.env` для production

```bash
cp .env.example .env
```

Заполните **обязательные** переменные:

```dotenv
APP_NAME="Khodakov Fashion House"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.ru

# Сгенерировать ключ: php artisan key:generate --show
APP_KEY=base64:...

DB_DATABASE=kfh_app
DB_USERNAME=kfh
DB_PASSWORD=<надёжный-пароль>
DB_ROOT_PASSWORD=<надёжный-root-пароль>

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
LOG_CHANNEL=stderr

# Автомиграции при старте контейнера (true — для первого деплоя; потом можно false)
RUN_MIGRATIONS=true

# Не публиковать MySQL наружу в production (оставьте пустым или закройте firewall)
DB_PUBLISH_PORT=
```

> **Важно:** `APP_KEY` должен быть задан **до** первого запуска. Сгенерируйте локально:
> ```bash
> php artisan key:generate --show
> ```
> и вставьте значение в `.env`.

### 4. Сборка и запуск

```bash
docker compose build --no-cache
docker compose up -d
```

Приложение доступно на порту **8080**: `http://<IP-сервера>:8080`

### 5. Создать администратора MoonShine

После успешного старта контейнеров:

```bash
docker compose exec app php artisan moonshine:user
```

Следуйте подсказкам (имя, email, пароль). Админка: `https://your-domain.ru/admin`

### 6. (Опционально) Заполнить демо-постами

```bash
docker compose exec app php artisan db:seed --class=PostSeeder
```

### 7. Reverse proxy и HTTPS (Nginx на хосте)

Пример конфигурации для проксирования на контейнер:

```nginx
server {
    listen 443 ssl http2;
    server_name your-domain.ru;

    ssl_certificate     /etc/letsencrypt/live/your-domain.ru/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/your-domain.ru/privkey.pem;

    client_max_body_size 32m;

    location / {
        proxy_pass http://127.0.0.1:8080;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Получить сертификат Let's Encrypt:

```bash
sudo certbot --nginx -d your-domain.ru
```

Убедитесь, что `APP_URL` в `.env` совпадает с публичным HTTPS-адресом.

### 8. Обновление приложения

```bash
git pull
docker compose build
docker compose up -d

# Если RUN_MIGRATIONS=false, миграции вручную:
docker compose exec app php artisan migrate --force
```

### 9. Полезные команды Docker

```bash
# Логи приложения
docker compose logs -f app

# Статус контейнеров
docker compose ps

# Остановка
docker compose down

# Остановка с удалением volumes (ОСТОРОЖНО — удалит БД!)
docker compose down -v

# Очистка кэша Laravel
docker compose exec app php artisan optimize:clear
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

---

## Развёртывание без Docker

Подходит для VPS с OSPanel, Laravel Forge, или ручной настройкой Nginx + PHP-FPM.

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build

cp .env.example .env
php artisan key:generate

# Настроить DB_* в .env
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan moonshine:user
```

### Nginx (document root)

```nginx
server {
    listen 80;
    server_name your-domain.ru;
    root /var/www/kfh-app/public;
    index index.php;

    client_max_body_size 32m;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Supervisor — очередь

```ini
[program:kfh-queue]
command=php /var/www/kfh-app/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
```

### Cron (планировщик Laravel)

```cron
* * * * * cd /var/www/kfh-app && php artisan schedule:run >> /dev/null 2>&1
```

---

## Админ-панель MoonShine

| URL | `/admin` (настраивается через `MOONSHINE_ROUTE_PREFIX`) |
|-----|--------------------------------------------------------|
| Разделы | Посты, заказы (новые / в обработке / завершённые / отклонённые) |
| Создание постов | Только через админку (публичная форма создания постов отключена) |

Первый администратор:

```bash
php artisan moonshine:user
# или в Docker:
docker compose exec app php artisan moonshine:user
```

---

## Проверка работоспособности

```bash
# Тесты
php artisan test --compact

# Health endpoint
curl -f http://localhost:8080/up

# Проверка маршрутов
php artisan route:list
```

---

## Структура Docker-образа

```
┌─────────────────────────────────────────┐
│  Multi-stage build                      │
├─────────────────────────────────────────┤
│  Stage 1 (node:20)   → npm run build    │
│  Stage 2 (composer)  → composer install │
│  Stage 3 (php-fpm)   → runtime          │
│    ├── Nginx :8080                      │
│    ├── PHP-FPM                          │
│    └── Supervisor → queue:work          │
└─────────────────────────────────────────┘
         │
         ▼
   MySQL 8 (контейнер db)
   Volume: storage (загрузки, логи)
   Volume: db (данные MySQL)
```

Файлы конфигурации:

| Файл | Назначение |
|------|------------|
| `Dockerfile` | Сборка production-образа |
| `docker-compose.yml` | Оркестрация app + db |
| `docker/nginx.conf` | Nginx внутри контейнера |
| `docker/supervisord.conf` | PHP-FPM, Nginx, queue worker |
| `docker/entrypoint.sh` | key:generate, storage:link, migrate, cache |

---

## Переменные окружения

| Переменная | Описание | Production |
|------------|----------|------------|
| `APP_KEY` | Ключ шифрования Laravel | **Обязательно** |
| `APP_URL` | Публичный URL сайта | `https://domain.ru` |
| `APP_DEBUG` | Режим отладки | `false` |
| `DB_*` | Подключение к MySQL | См. docker-compose |
| `FILESYSTEM_DISK` | Диск для загрузок | `public` |
| `RUN_MIGRATIONS` | Автомиграции при старте | `true` / `false` |
| `DB_PUBLISH_PORT` | Проброс порта MySQL | Пусто в production |
| `MOONSHINE_ROUTE_PREFIX` | Префикс админки | `admin` |

Полный список — в файле `.env.example`.

---

## Решение проблем

### `Unable to locate file in Vite manifest`

Ассеты не собраны. Пересоберите образ или локально:

```bash
npm run build
# Docker:
docker compose build --no-cache
```

### `500` / `No application encryption key`

Задайте `APP_KEY` в `.env` и перезапустите:

```bash
php artisan key:generate --show   # скопировать в .env
docker compose up -d --force-recreate
```

### Изображения постов не отображаются

```bash
php artisan storage:link
# Docker:
docker compose exec app php artisan storage:link
```

Убедитесь, что `FILESYSTEM_DISK=public` и volume `storage` подключён.

### База данных недоступна при старте

Контейнер `app` ждёт healthcheck MySQL (до ~2 мин). Проверьте:

```bash
docker compose logs db
docker compose ps
```

### Очередь не обрабатывает задачи

В Docker worker запускается через Supervisor. Проверка:

```bash
docker compose exec app supervisorctl status
```

---

## Лицензия

Проект построен на [Laravel](https://laravel.com) (MIT License).
