FROM php:8.1-fpm

# Defina uma variável de ambiente para o diretório da aplicação
ENV APP_DIR=/var/www/html/api_fanwitch

WORKDIR $APP_DIR

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
COPY . $APP_DIR

# Copiar o arquivo de ambiente
COPY .env.example .env

# Instalar dependências do Composer
RUN composer install --no-scripts --no-autoloader

# Expor a porta 8000
EXPOSE 8000

# Configuração do PHP para o Laravel
RUN chown -R www-data:www-data $APP_DIR

# Comando para gerar a chave do Laravel e rodar as migrações e seeds
CMD composer dump-autoload && php artisan key:generate && php artisan migrate --seed && php artisan serve --host=0.0.0.0 --port=8000
