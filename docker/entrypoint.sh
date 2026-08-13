#!/bin/sh

set -e

cd /app

echo "=================================================="
echo "Starting Laravel / FrankenPHP container"
echo "=================================================="

echo "UID: $(id -u)"
echo "GID: $(id -g)"

# ============================================================
# Git
# ============================================================

git config --global --add safe.directory /app || true

# ============================================================
# Prepare Laravel directories
# ============================================================

echo "Preparing Laravel directories..."

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    bootstrap/cache/filament

# ============================================================
# Fix ownership
#
# IMPORTANT:
# We DO NOT chown /app.
#
# /app is a bind mount from the host.
# Chowning /app would modify ownership of the host project.
#
# node_modules and vendor are Docker named volumes,
# therefore it is safe to chown them here.
# ============================================================

echo "Fixing ownership of Docker volumes..."

chown -R www-data:www-data /app/node_modules
chown -R www-data:www-data /app/vendor

chown -R www-data:www-data /app/storage
chown -R www-data:www-data /app/bootstrap/cache

chmod -R 775 /app/storage
chmod -R 775 /app/bootstrap/cache

# ============================================================
# Composer
# ============================================================

echo "Checking Composer dependencies..."

if [ ! -f "/app/vendor/autoload.php" ]; then

    echo "Composer dependencies not found."
    echo "Running composer install as www-data..."

    su-exec www-data composer install \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader

else

    echo "Composer dependencies already installed."

fi

# ============================================================
# Bun / Node modules
# ============================================================

ensure_node_modules() {

    if [ -d "/app/node_modules" ] \
        && [ -x "/app/node_modules/.bin/vite" ] \
        && su-exec www-data bun --version >/dev/null 2>&1
    then

        if su-exec www-data bun run --silent >/dev/null 2>&1; then
            :
        fi

        if su-exec www-data node -e "require('lightningcss')" >/dev/null 2>&1; then
            echo "Node modules are ready."
            return 0
        fi

    fi

    echo "Node modules missing or incompatible."
    echo "Running bun install as www-data..."

    su-exec www-data bun install

    echo "Fixing node_modules ownership..."

    chown -R www-data:www-data /app/node_modules
}

ensure_node_modules

# ============================================================
# Final permissions
# ============================================================

chown -R www-data:www-data \
    /app/storage \
    /app/bootstrap/cache

chmod -R 775 \
    /app/storage \
    /app/bootstrap/cache

# ============================================================
# Database
# ============================================================

if [ -n "$DB_HOST" ]; then

    echo "Waiting for database ($DB_HOST)..."

    until nc -z -w 5 "$DB_HOST" 3306; do
        echo "Database is unavailable - sleeping..."
        sleep 2
    done

    echo "Database is up!"

fi

# ============================================================
# Clear Laravel stale cache
# ============================================================

echo "Clearing stale Laravel cache..."

rm -f /app/bootstrap/cache/*.php

# ============================================================
# Storage symlink
# ============================================================

echo "Ensuring storage link..."

su-exec www-data php artisan storage:link --force 2>/dev/null || true

# ============================================================
# APP_KEY
# ============================================================

if [ -z "$APP_KEY" ]; then

    echo "APP_KEY is missing."
    echo "Generating APP_KEY..."

    su-exec www-data php artisan key:generate --force

fi

# ============================================================
# Database migrations
# ============================================================

if [ "$APP_ENV" = "local" ]; then

    echo "Running migrations..."

    su-exec www-data php artisan migrate --force

fi

# ============================================================
# Vite
# ============================================================

if [ "$APP_ENV" = "local" ]; then

    echo "Starting Vite..."

    su-exec www-data \
        bun run dev -- --host 0.0.0.0 &

else

    echo "Building production assets..."

    su-exec www-data \
        bun run build

fi

# ============================================================
# FrankenPHP / Octane
# ============================================================

echo "Starting Octane with FrankenPHP..."

exec su-exec www-data \
    php artisan octane:frankenphp \
    "$@" \
    --host=0.0.0.0 \
    --port=8000
