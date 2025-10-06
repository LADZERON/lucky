FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Установка дополнительных PHP расширений (Redis убран для тестового задания)

# Создание пользователя для приложения
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

# Копирование существующего содержимого приложения
COPY . /var/www/html

# Установка рабочей директории
WORKDIR /var/www/html

# Установка зависимостей (выполняется от имени root)
RUN composer install --optimize-autoloader --no-dev \
    && npm install

# Копирование переменных окружения
RUN if [ -f .env.example ]; then cp .env.example .env; fi

# Изменение владельца файлов
RUN chown -R www:www /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Переключение на пользователя www
USER www

# Открытие порта
EXPOSE 9000

# Команда запуска
CMD ["php-fpm"]
