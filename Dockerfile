FROM php:7.3-apache


RUN a2enmod rewrite
RUN a2enmod headers

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

ADD ./wp.ini $PHP_INI_DIR/conf.d/
