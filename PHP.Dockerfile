FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql
#RUN apt-get update && apt-get install -y nginx-extras

# RUN pecl install xdebug && docker-php-ext-enable xdebug