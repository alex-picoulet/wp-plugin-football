FROM php:7.4-apache

RUN apt-get update -y && apt-get upgrade -y;
RUN apt-get update && apt-get install -y \
        libxml2-dev \
	curl \
	libzip-dev \
	libcurl4-openssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg && a2enmod rewrite
#RUN pecl install xdebug-3.1.6 && docker-php-ext-enable xdebug
RUN docker-php-ext-install -j$(nproc) xmlrpc 
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli 
RUN docker-php-ext-install curl && docker-php-ext-enable curl
RUN docker-php-ext-install json && docker-php-ext-enable json
RUN docker-php-ext-install dom && docker-php-ext-enable dom
RUN docker-php-ext-install fileinfo && docker-php-ext-enable fileinfo 
RUN docker-php-ext-install zip && docker-php-ext-enable zip 
RUN docker-php-ext-install gd && docker-php-ext-enable gd 
RUN docker-php-ext-install xml && docker-php-ext-enable xml