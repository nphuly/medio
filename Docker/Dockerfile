# Sử dụng image PHP 8.3 với Apache
FROM php:8.3-apache

# Cài đặt các extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    icu-devtools \
    zip \
    unzip \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql gd intl zip \
    && rm -rf /var/lib/apt/lists/*

# xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

COPY Docker/config/docker-php-ext-xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài đặt NodeJS + npm (dùng cho Tailwind)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Cài đặt phiên bản npm tương thích
RUN npm install -g npm@10.8.2


# Tạo thư mục app
WORKDIR /var/www/html

# Copy toàn bộ source code vào container
COPY . .

# Cài đặt Laravel dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Phân quyền storage
RUN chmod -R 777 storage bootstrap/cache

# Bật mod_rewrite (Laravel cần .htaccess)
RUN a2enmod rewrite

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Expose cổng 80
EXPOSE 80

CMD ["apache2-foreground"]
