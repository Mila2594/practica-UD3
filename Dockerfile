# Usamos la imagen oficial de PHP CLI
FROM php:8.2-cli

# Instalamos dependencias necesarias para Laravel (dependencias de PHP y herramientas)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalamos Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Establecemos el directorio de trabajo
WORKDIR /app

# Copiamos todo el contenido de EduPro al contenedor
COPY EduPro/ /app/

# Instalamos las dependencias de Composer
RUN composer install --no-interaction --no-dev --prefer-dist

# Configuramos permisos para las carpetas de almacenamiento y caché
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Exponemos el puerto para la comunicación con Laravel (por si lo necesitas)
EXPOSE 8000

# Definimos el comando por defecto (en este caso, ejecutamos el servidor PHP para Laravel)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
