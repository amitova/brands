FROM php:8.2-apache AS web

# Install system dependencies and PHP extensions
RUN apt-get update \
 && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
 && docker-php-ext-install pdo_mysql mbstring zip \
 && a2enmod rewrite

WORKDIR /var/www/html

# Adjust Apache to use the public directory
RUN sed -ri \
    -e 's@DocumentRoot /var/www/html@DocumentRoot /var/www/html/public@g' \
    /etc/apache2/sites-available/*.conf \
 && sed -ri \
    -e 's@<Directory /var/www/html>@<Directory /var/www/html/public>@g' \
    /etc/apache2/apache2.conf

# Copy application files
COPY . .

# Copy Composer and install dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
