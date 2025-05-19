FROM php:8.1-fpm

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

# 安装 Composer
RUN curl -sS https://install.phpcomposer.com/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 验证 Composer 是否安装成功
RUN composer --version || echo "Composer installation failed"

# 设置工作目录
WORKDIR /var/www/html

# 复制项目文件
COPY . .

# 解决 Git 所有权问题
RUN git config --global --add safe.directory /var/www/html

# 安装依赖
RUN composer install --ignore-platform-reqs

# 设置权限
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage
