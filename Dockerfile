# Stage 1: Composer install dependencies
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./

# Install semua dependency Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-progress --no-interaction \
    && composer require mongodb/laravel-mongodb --no-progress --no-interaction

# Stage 2: PHP + Apache
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl gd \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Copy vendor folder dari stage vendor
COPY --from=vendor /app/vendor /var/www/html/vendor

# Apache config untuk Laravel (pointing ke /public)
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
