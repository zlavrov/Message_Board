FROM php:8.2-apache

# Установка необходимых расширений PHP
RUN docker-php-ext-install mysqli pdo_mysql

# Включение модуля mod_rewrite для Apache
RUN a2enmod rewrite
