FROM php:8.3-fpm-bullseye

USER root

# Criar grupo e usuário com UID recebido
RUN groupadd -g 1000 appgroup \
    && useradd -u 1000 -g appgroup -m appuser

# === Variáveis de ambiente ===
ENV ACCEPT_EULA=Y \
    OCI_DIR=/opt/oracle/instantclient \
    ORACLE_VERSION=21

WORKDIR /var/www

# === Dependências básicas e de compilação ===
RUN apt-get update && apt-get install -y --no-install-recommends \
    git zip curl unzip vim gnupg apt-transport-https sqlite3 \
    build-essential libzip-dev libonig-dev libxml2-dev \
    libsqlite3-dev libpq-dev unixodbc-dev libaio-dev libzip-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# === Extensões PHP padrão (Laravel / Postgres) ===
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip mbstring exif pcntl gd bcmath pdo pdo_pgsql \
    && docker-php-ext-enable gd pdo_pgsql

# === Composer ===
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# === Node.js 20.x ===
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && node -v && npm -v

COPY package*.json ./
RUN rm -rf node_modules package-lock.json 

RUN npm install --legacy-peer-deps
COPY . .

EXPOSE 5173

USER appuser
CMD ["composer", "run", "dev"]