#!/bin/bash

echo "🚀 Setting up Docker environment for Laravel..."

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Update .env with Docker database settings
echo "🔧 Updating database configuration for Docker..."
sed -i '' 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
sed -i '' 's/DB_DATABASE=laravel/DB_DATABASE=laravel_db/g' .env
sed -i '' 's/DB_USERNAME=root/DB_USERNAME=laravel_user/g' .env
sed -i '' 's/DB_PASSWORD=/DB_PASSWORD=laravel_password/g' .env

echo "✅ Docker environment setup complete!"
echo ""
echo "📋 Next steps:"
echo "1. Run: docker-compose up -d"
echo "2. Run: docker-compose exec app composer install"
echo "3. Run: docker-compose exec app php artisan key:generate"
echo "4. Run: docker-compose exec app php artisan migrate"
echo "5. Run: docker-compose exec app php artisan db:seed"
echo ""
echo "🌐 Access your application at: http://localhost:8000"
echo "🗄️  Access phpMyAdmin at: http://localhost:8080"
echo "   - Username: laravel_user"
echo "   - Password: laravel_password"
