# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install ekstensi MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy semua file Laravel ke container
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Berikan izin storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Laravel listen di port 10000 (sesuai Render)
EXPOSE 10000

# Jalankan Laravel pakai Artisan Serve
CMD php artisan serve --host=0.0.0.0 --port=10000
