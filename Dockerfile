## Production image: nginx + php-fpm (+ optional queue worker) for Laravel
## Multi-stage: build assets with Node, vendor with Composer, final runtime with PHP-FPM+Nginx.

FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
  --no-dev \
  --no-interaction \
  --no-progress \
  --prefer-dist \
  --optimize-autoloader

FROM php:8.3-fpm-alpine AS runtime
WORKDIR /var/www/html

RUN apk add --no-cache \
    bash \
    ca-certificates \
    curl \
    icu-libs \
    nginx \
    supervisor \
    tzdata \
  && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    oniguruma-dev \
  && docker-php-ext-install -j"$(nproc)" \
    pdo_mysql \
    intl \
    mbstring \
    opcache \
  && apk del .build-deps

COPY --from=vendor /usr/bin/composer /usr/local/bin/composer

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh \
  && mkdir -p /var/log/supervisor /run/nginx \
  && chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R ug+rwX storage bootstrap/cache

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
