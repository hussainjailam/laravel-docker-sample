FROM php:8.2-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libgd-dev
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-configure gd --with-external-gd && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /var/www
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www
COPY --chown=www:www . /var/www
USER www

EXPOSE 9000
CMD ["php-fpm"]
