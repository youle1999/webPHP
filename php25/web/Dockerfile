# Use the official PHP image with Apache
FROM php:7.4-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the source code into the container
COPY . /var/www/html

# Expose port 80 to the outside world
EXPOSE 80
