FROM php:8.2-apache

# Étiquettes d'image (remplacez les valeurs par celles correspondant à votre projet)
LABEL maintainer="Votre Nom <lemperiere.charles@gmail.com>"
LABEL version="1.0"
LABEL description="Image Docker projet Exsana"

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev unzip \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen

# Installation de Composer (version globale)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installation de Node.js (version globale)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash \
    && apt-get install -y nodejs

# Installation de Symfony CLI (version globale)
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin

# Configuration et installation des extensions PHP nécessaires
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl \
    && pecl install apcu && docker-php-ext-enable apcu

# Répertoire de travail
WORKDIR /var/www/

# Copie des fichiers du projet
COPY . .

# Exclusion des fichiers et répertoires inutiles
COPY .dockerignore .

# Exposition du port 80 pour accéder au site web
EXPOSE 80

