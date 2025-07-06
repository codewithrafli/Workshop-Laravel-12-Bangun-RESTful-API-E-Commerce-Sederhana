# Docker Setup untuk Laravel E-Commerce API

Setup Docker sederhana untuk menjalankan aplikasi Laravel dengan PHP, MySQL, dan Nginx.

## 🐳 Services yang Tersedia

- **PHP 8.2** - Laravel application
- **MySQL 8.0** - Database
- **Nginx** - Web server
- **phpMyAdmin** - Database management

## 🚀 Cara Menjalankan

### 1. Setup Environment
```bash
# Jalankan script setup
./docker-setup.sh
```

### 2. Build dan Jalankan Containers
```bash
# Build dan jalankan semua services
docker-compose up -d

# Atau build ulang jika ada perubahan
docker-compose up -d --build
```

### 3. Install Dependencies Laravel
```bash
# Install Composer dependencies
docker-compose exec app composer install

# Generate application key
docker-compose exec app php artisan key:generate

# Jalankan migrations
docker-compose exec app php artisan migrate

# Jalankan seeders (opsional)
docker-compose exec app php artisan db:seed
```

## 🌐 Akses Aplikasi

- **Laravel Application**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080
  - Username: `laravel_user`
  - Password: `laravel_password`

## 📁 Struktur Docker

```
docker/
├── nginx/
│   └── conf.d/
│       └── app.conf          # Nginx configuration
├── php/
│   └── local.ini            # PHP configuration
└── mysql/
    └── my.cnf               # MySQL configuration
```

## 🔧 Konfigurasi Database

Database settings di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password
```

## 📋 Perintah Berguna

### Container Management
```bash
# Lihat status containers
docker-compose ps

# Lihat logs
docker-compose logs

# Lihat logs specific service
docker-compose logs app
docker-compose logs db
docker-compose logs webserver

# Stop containers
docker-compose down

# Stop dan hapus volumes
docker-compose down -v
```

### Laravel Commands
```bash
# Masuk ke container app
docker-compose exec app bash

# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear

# Create new controller
docker-compose exec app php artisan make:controller NewController

# Run tests
docker-compose exec app php artisan test
```

### Database Commands
```bash
# Masuk ke MySQL container
docker-compose exec db mysql -u laravel_user -p laravel_db

# Backup database
docker-compose exec db mysqldump -u laravel_user -p laravel_db > backup.sql

# Restore database
docker-compose exec -T db mysql -u laravel_user -p laravel_db < backup.sql
```

## 🛠️ Troubleshooting

### Port Already in Use
Jika port 8000 atau 3306 sudah digunakan:
```bash
# Edit docker-compose.yml dan ubah ports
ports:
  - "8001:80"  # Ganti 8000 dengan port lain
```

### Permission Issues
```bash
# Fix storage permissions
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Database Connection Issues
```bash
# Restart database service
docker-compose restart db

# Check database logs
docker-compose logs db
```

## 🔄 Development Workflow

1. **Start development**: `docker-compose up -d`
2. **Make changes** to your Laravel code
3. **View changes** at http://localhost:8000
4. **Database changes**: Use phpMyAdmin at http://localhost:8080
5. **Stop development**: `docker-compose down`

## 📝 Notes

- Data MySQL akan tersimpan di volume `dbdata`
- File Laravel akan di-mount dari host ke container
- Perubahan kode akan langsung terlihat tanpa rebuild
- Untuk production, gunakan environment variables yang aman 
