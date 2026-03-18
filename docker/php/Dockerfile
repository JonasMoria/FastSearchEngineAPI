FROM php:8.3-fpm

# Recebe UID/GID dinamicamente
ARG UID=1000
ARG GID=1000

# Ajusta o usuário www-data para bater com o host
RUN groupmod -g ${GID} www-data \
    && usermod -u ${UID} -g ${GID} www-data

# Dependências
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install \
    pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório temporário
RUN mkdir -p /tmp && chmod 777 /tmp

WORKDIR /var/www

USER www-data

CMD ["php-fpm"]