FROM php:8.1-fpm

WORKDIR /var/www/html/api_fanwitch

# Instalação do Composer e dependências
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        git \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar o código da aplicação
COPY . /var/www/html/api_fanwitch

# Copiar o arquivo de ambiente
COPY .env.example .env

# Instalar dependências do Composer
RUN composer install --no-scripts --no-autoloader

# Gerar chave do Laravel
RUN php artisan key:generate

# Rodar as migrações e seed do banco de dados
RUN php artisan migrate --seed

# Expor a porta 8000
EXPOSE 8000

# Configuração do PHP para o Laravel
RUN chown -R www-data:www-data /var/www/html/api_fanwitch

# Comando padrão para iniciar o servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]