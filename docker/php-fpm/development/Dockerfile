FROM php:7.4-fpm-alpine

RUN apk --no-cache add autoconf g++ make \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear; apk del autoconf g++ make;

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php-fpm/development/conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www
