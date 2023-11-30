# Use the official PHP 8.2 image as the base image
FROM php:8.2

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        libonig-dev \
        libxml2-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        libjpeg62-turbo-dev \
        sqlite3 \
        libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd zip

# Copy the local Laravel files to the container
COPY . .

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies using Composer
RUN composer install --optimize-autoloader --no-dev

# Set up environment file
RUN cp .env.example .env

# Generate application key
RUN php artisan key:generate

# Create SQLite database file
RUN touch database/database.sqlite

# Run Laravel migrations
RUN php artisan migrate

# Expose port 8000 for the Laravel development server
EXPOSE 8000

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
