# استخدم PHP 8.2 بدلاً من 8.1
FROM php:8.2-fpm

# ضبط مسار العمل
WORKDIR /var/www/html

# تثبيت الحزم المطلوبة
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
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع
COPY . /var/www/html

# ضبط الصلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# تثبيت الحزم عبر npm
RUN npm install

# بناء الأصول
RUN npm run build

# تثبيت حزم Composer
RUN composer install --no-dev --optimize-autoloader

# كشف المنفذ 8000
EXPOSE 8000

# تشغيل Laravel بطريقة آمنة
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
