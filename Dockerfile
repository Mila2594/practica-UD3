# Usar la imagen oficial de PHP 8.3 CLI
FROM php:8.2-cli

# Instalar extensiones requeridas
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar directorio de trabajo
WORKDIR /app

# Copiar los archivos del proyecto
COPY EduPro/ .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 8000 para el servidor embebido de PHP
EXPOSE 8000

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html
