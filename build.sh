#!/bin/bash

# Configuration - adjust the paths to your environment
ZIP_PATH="/home/marysiappl/tes/my-laravel-project.zip"
PROJECT_DIR="/home/marysiappl/tes/my-proj"

echo "Removing existing project directory (if it exists)..."
rm -rf "$PROJECT_DIR"

echo "Creating a new Laravel project..."
composer create-project laravel/laravel "$PROJECT_DIR"

cd "$PROJECT_DIR" || { echo "Failed to enter project directory"; exit 1; }

echo "Unzipping project files from ZIP archive..."
unzip -o "$ZIP_PATH" -d "$PROJECT_DIR"

echo "Installing Composer dependencies..."
composer install

echo "Installing npm dependencies (if needed)..."
npm install

echo "Ensuring proper directory structure..."
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs

echo "Setting correct permissions..."
chmod -R 775 storage bootstrap/cache

echo "Starting Docker containers..."
docker compose up -d

echo "Waiting for the database to be ready (10s)..."
sleep 10

# ⚠️ Make sure to update your .env file with correct database credentials:
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=eventflow
# DB_USERNAME=your_user
# DB_PASSWORD=your_password

echo "Installing PostgreSQL PHP extension..."
sudo apt-get update
sudo apt-get install -y php-pgsql

echo "Running database migrations..."
php artisan migrate --force

echo "Project setup complete! ✅"
