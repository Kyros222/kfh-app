#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R ug+rwX storage bootstrap/cache || true

if [[ "${APP_ENV:-}" == "production" ]]; then
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
fi

if [[ "${RUN_MIGRATIONS:-false}" == "true" ]]; then
  echo "Waiting for database..."
  for i in $(seq 1 60); do
    php -r 'try { new PDO("mysql:host=".getenv("DB_HOST").";port=".getenv("DB_PORT").";dbname=".getenv("DB_DATABASE"), getenv("DB_USERNAME"), getenv("DB_PASSWORD")); echo "OK\n"; } catch (Throwable $e) { exit(1); }' && break
    sleep 2
  done
  php artisan migrate --force
fi

exec "$@"
