FROM php:8.2-apache

# Instalamos las extensiones necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite en Apache para URLs limpias
RUN a2enmod rewrite

# Copiar el código fuente de `src/` a la carpeta de Apache
COPY src/ /var/www/html/

# Ajustar permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para Render y local
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
