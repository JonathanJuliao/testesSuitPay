FROM php:8.1-fpm-alpine
RUN apk update && apk add --no-cache \
    bash \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip opcache intl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www
COPY . .
RUN composer install --no-interaction --optimize-autoloader
EXPOSE 9000
CMD ["php-fpm"]