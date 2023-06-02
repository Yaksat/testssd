FROM php:8.0-fpm

WORKDIR /var/www/html
COPY . .

ENV LC_ALL=C.UTF-8
ENV DEBIAN_FRONTEND=noninteractive

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    zlib1g-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libxpm-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    libldb-dev  \
    libldap2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libsqlite3-dev\
    sqlite3

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-webp \
    --with-jpeg \
    --with-xpm \
    --with-freetype

# Install PHP extensions
RUN docker-php-ext-install gd zip sockets pdo_mysql ldap exif

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Clean up
RUN apt-get clean \
    && apt-get -y autoremove \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


COPY ./docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./docker/php/conf.d/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

# xdebug installation
RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user
