FROM composer:2.5 AS composer_base
FROM php:8.1-fpm
COPY --from=composer_base /usr/bin/composer /usr/local/bin/composer

# 验证 Composer 是否安装成功
RUN composer --version || { echo "Composer installation failed"; exit 1; }

# 安装依赖
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev

# 安装 PHP 扩展（包括 PostgreSQL 和 zip 扩展）
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql pgsql zip

# 设置工作目录
WORKDIR /www/app

# 复制项目文件
COPY . .

# 解决 Git 所有权问题
RUN git config --global --add safe.directory /www/app

# 安装依赖
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --ignore-platform-reqs

# 设置权限
RUN chown -R www-data:www-data /www/app \
    && chmod -R 755 /www/app/storage

# 安装管理面板
RUN php artisan admin:install
