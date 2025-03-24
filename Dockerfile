# استخدام صورة PHP مع Nginx
FROM php:8.2-fpm

# تثبيت التبعية المطلوبة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    unzip \
    libzip-dev \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# إعداد مجلد العمل
WORKDIR /var/www

# نسخ جميع الملفات إلى الحاوية
COPY . .

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت الحزم عبر Composer
RUN composer install --no-dev --optimize-autoloader

# تثبيت الحزم عبر npm وبناء الأصول
RUN npm install && npm run build

# إعداد الأذونات المناسبة
RUN chown -R www-data:www-data /var/www

# نسخ ملف Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# فتح المنفذ 8080
EXPOSE 8080

# بدء الخدمة
CMD ["php-fpm"]
