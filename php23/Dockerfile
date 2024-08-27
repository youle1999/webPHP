# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the current directory contents into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install necessary PHP extensions (e.g., MySQL, PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 80
EXPOSE 80
