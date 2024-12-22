FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install

# Expose port 8000 and start PHP server (optional)
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
