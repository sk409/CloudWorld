FROM php:7.2-fpm
#COPY php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get install -y zlib1g-dev mariadb-client git\
    && docker-php-ext-install zip pdo_mysql