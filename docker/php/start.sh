#!/bin/bash
set -e

echo "🚀 Starting EduBridge AI Backend..."

# Install composer dependencies if vendor folder is empty
if [ ! -d "/var/www/vendor" ] || [ ! -f "/var/www/vendor/autoload.php" ]; then
    echo "📦 Installing Composer dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# Generate app key if not set
if grep -q "APP_KEY=$" /var/www/.env 2>/dev/null; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Wait for PostgreSQL to be ready using simple PHP PDO check
echo "⏳ Waiting for PostgreSQL..."
max_retries=30
retry_count=0
until php -r "try { new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'ok'; } catch(Exception \$e) { exit(1); }" 2>/dev/null; do
    retry_count=$((retry_count + 1))
    if [ $retry_count -ge $max_retries ]; then
        echo "❌ Could not connect to PostgreSQL after $max_retries attempts"
        exit 1
    fi
    echo "   Retrying... ($retry_count/$max_retries)"
    sleep 2
done
echo "✅ PostgreSQL is ready!"

# Run migrations
echo "📋 Running migrations..."
php artisan migrate --force

# Clear and cache config
echo "⚙️ Optimizing..."
php artisan config:clear
php artisan route:clear

# Create storage link if not exists
if [ ! -L "/var/www/public/storage" ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link
fi

echo "✅ EduBridge AI Backend is ready!"
echo "🌐 Starting server on port 8000..."

# Start the server
php artisan serve --host=0.0.0.0 --port=8000
