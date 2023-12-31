# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . /var/www/html/

# Enable PHP SQLite extension
RUN apt-get update && apt-get install -y libsqlite3-dev sqlite3
RUN docker-php-ext-install pdo pdo_sqlite
