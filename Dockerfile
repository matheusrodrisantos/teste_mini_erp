FROM php:8.4-apache-bullseye

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zip \ 
        wget \
        unzip \ 
        libzip-dev \ 
        && docker-php-ext-install pdo pdo_mysql \
        && docker-php-ext-install zip

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get install libxml2-dev -y

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN a2enmod rewrite

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 80
