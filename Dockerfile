# Base stage with PHP and system dependencies
FROM phpswoole/swoole:php8.2 AS base
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libssl-dev \
    wait-for-it

# PHP extensions stage
FROM base AS php-extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Dependencies and application stage
FROM php-extensions AS app
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first
COPY composer.* ./

# Install base dependencies
RUN composer install --no-scripts --no-autoloader

# Copy application
COPY . .

# Install Octane and generate configs
RUN composer require laravel/octane && \
    php artisan vendor:publish --provider="Laravel\Octane\OctaneServiceProvider" --force && \
    composer dump-autoload -o && \
    php artisan optimize

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8005

CMD ["sh", "-c", "php artisan octane:install --server=swoole && wait-for-it db:3306 -t 60 -- php artisan migrate --force && php artisan octane:start --server=swoole --host=0.0.0.0 --port=8005"]
