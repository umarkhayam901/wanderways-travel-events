#!/bin/sh
set -e

# Default PORT to 8000 if not provided by Render environment
PORT="${PORT:-8000}"

echo "Starting WanderWays Travel Application on port ${PORT}..."

# Ensure storage and bootstrap/cache subdirectories exist with appropriate permissions
mkdir -p /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# If automated remote migrations are enabled on deployment, run them
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
    if [ "$RUN_SEEDER" = "true" ]; then
        echo "Running database seeder..."
        php artisan db:seed --force
    fi
fi

# Clear and optimize configuration for production
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Start Laravel built-in server bound to 0.0.0.0 and dynamic Render $PORT
exec php -S 0.0.0.0:"${PORT}" -t public
