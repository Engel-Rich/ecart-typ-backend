
FROM php:8.2-fpm-alpine
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Mise à jour des paquets et installation des dépendances
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip
RUN apk --no-cache add shadow

# Installer Supervisor
# RUN apk --no-cache add supervisor

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN docker-php-ext-install zip

# COPY --chown=www:www . /www/html/ecartify
# RUN composer install --no-dev --optimize-autoloader


RUN addgroup -g 1000 manager && adduser -u 1000 -G manager -D manager
RUN addgroup -g 1001 -S www && adduser -u 1001 -S www -G www

# RUN composer install --no-dev --optimize-autoloader
# RUN php artisan migrate
# supervisor configuration
# COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /www/html/ecartify
COPY --chown=www:www . .
COPY custom-php.ini /usr/local/etc/php/conf.d/

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www:www /www/html/ecartify/storage /www/html/ecartify/bootstrap/cache
RUN chmod -R 777 /www/html/ecartify/storage /www/html/ecartify/bootstrap/cache

EXPOSE 9000

# CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
CMD ["php-fpm"]
