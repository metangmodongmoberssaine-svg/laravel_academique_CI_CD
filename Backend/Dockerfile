FROM php:8.2-fpm-alpine

# Installation des dépendances système
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    curl

# Installation des extensions PHP
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apk del .build-deps

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copie des configurations Nginx et Supervisor
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copie du code source (on est déjà dans Backend, donc on copie .)
COPY . .

# Installation des dépendances Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev --prefer-dist

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]