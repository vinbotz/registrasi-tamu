FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    git curl libzip-dev unzip libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . /var/www/html
RUN chmod +x /var/www/html/start.sh

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set DocumentRoot to public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run Laravel Commands
RUN composer install --no-dev --optimize-autoloader

CMD ["sh", "./start.sh"]
