FROM php:7.3-apache


RUN a2enmod rewrite
RUN a2enmod headers

ADD ./wp.ini $PHP_INI_DIR/conf.d/
