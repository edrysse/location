# استخدم PHP 8.2
FROM php:8.2-fpm

# تثبيت الأدوات الأساسية والمكتبات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    gnupg \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl

# تثبيت Node.js و npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ضبط مسار العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# ضبط الصلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تثبيت الحزم باستخدام Composer
RUN composer install --no-dev --optimize-autoloader

# تثبيت حزم npm وبناء الأصول
RUN npm install && npm run build

RUN php artisan storage:link

# كشف المنفذ 8000
EXPOSE 8000

# تشغيل Laravel بطريقة آمنة
CMD ["php-fpm"]
