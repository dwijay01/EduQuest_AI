#!/bin/bash
set -e

echo "🚀 Deploying EduBridge AI..."

PROJECT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$PROJECT_DIR"

# 1. Pull latest code
echo "📥 Pulling latest code..."
git pull origin main

# 2. Copy production env if .env doesn't exist
if [ ! -f "backend/.env" ]; then
    echo "📋 Setting up production .env..."
    cp backend/.env.production backend/.env
fi

# 3. Build frontend
echo "🔨 Building frontend..."
cd frontend
npm install --production=false
npm run build
cd ..

# 4. Build and start Docker containers
echo "🐳 Building and starting containers..."
docker-compose -f docker-compose.prod.yml up -d --build

# 5. Wait for services to be healthy
echo "⏳ Waiting for services..."
sleep 10

# 6. Run Laravel setup inside container
echo "📦 Installing backend dependencies..."
docker exec edubridge_ai-app-1 composer install --no-dev --optimize-autoloader

echo "🔑 Generating app key..."
docker exec edubridge_ai-app-1 php artisan key:generate --force

echo "📋 Running migrations..."
docker exec edubridge_ai-app-1 php artisan migrate --force

echo "🌱 Running seeders..."
docker exec edubridge_ai-app-1 php artisan db:seed --force

echo "⚙️ Caching config..."
docker exec edubridge_ai-app-1 php artisan config:cache
docker exec edubridge_ai-app-1 php artisan route:cache
docker exec edubridge_ai-app-1 php artisan view:cache

echo "🔗 Creating storage link..."
docker exec edubridge_ai-app-1 php artisan storage:link 2>/dev/null || true

echo ""
echo "✅ EduBridge AI deployed successfully!"
echo "🌐 Frontend: https://edu.alipayment.id"
echo "🔌 API: https://edu.alipayment.id/api"
echo ""
echo "📌 Jangan lupa update Cloudflare Tunnel config:"
echo "   sudo nano /etc/cloudflared/config.yml"
echo "   Tambahkan:"
echo "     - hostname: edu.alipayment.id"
echo "       service: http://localhost:8083"
echo "   sudo systemctl restart cloudflared"
