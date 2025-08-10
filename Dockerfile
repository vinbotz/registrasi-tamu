# Stage 1: Composer install dependencies
FROM composer:2 AS vendor

# Install ekstensi mongodb di stage composer
RUN apk add --no-cache autoconf g++ make \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

WORKDIR /app

# Copy file composer untuk cache
COPY composer.json composer.lock ./

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-progress --no-interaction

# Copy semua source code Laravel
COPY . /app

# Optimalkan autoload
RUN composer dump-autoload --optimize


# Stage 2: PHP + Apache untuk runtime
FROM php:8.2-apache

# Install dependencies PHP
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl gd \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite

WORKDIR /var/www/html

# Copy semua file kecuali vendor
COPY . /var/www/html

# Copy vendor hasil dari stage composer
COPY --from=vendor /app/vendor /var/www/html/vendor

# Apache config untuk Laravel
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
