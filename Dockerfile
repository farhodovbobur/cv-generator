FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zsh \
    git \
    curl \
    zip \
    unzip \
    vim \
    wget \
    libpq-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql

# Set Zsh as the default shell
RUN chsh -s /bin/zsh

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

