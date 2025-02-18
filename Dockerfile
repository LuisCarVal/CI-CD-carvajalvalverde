# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Instala las extensiones necesarias de PHP para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    zip git npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli\
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite de Apache para Laravel
RUN a2enmod rewrite

# Copiar el archivo de configuración personalizado de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Crear el directorio del proyecto y copiar los archivos
RUN mkdir -p /var/www/html/carvajalvalverde/
COPY . /var/www/html/carvajalvalverde

# Establecer el directorio de trabajo
WORKDIR /var/www/html/carvajalvalverde

# Instalar gestor de paquetes composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar las dependencias del proyecto Laravel
RUN composer install

# Cambiar permisos en las carpetas de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html/carvajalvalverde/storage /var/www/html/carvajalvalverde/bootstrap/cache
RUN chmod -R 775 /var/www/html/carvajalvalverde/storage /var/www/html/carvajalvalverde/bootstrap/cache

# Instalar las dependencias con npm
RUN npm install && npm run build

# Cambiar al usuario www-data
USER www-data

# Exponer el puerto 80
EXPOSE 80

