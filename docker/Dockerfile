FROM php:8.4-fpm

RUN apt-get update \
  && apt-get install -y \
             libfreetype6-dev \
             libjpeg62-turbo-dev \
             libpng-dev \
             zlib1g-dev \
             libxml2-dev \
             libzip-dev \
             libonig-dev \
             graphviz \
             libcurl4-openssl-dev \
             default-mysql-client \
             pkg-config \
             libpq-dev \
             librabbitmq-dev \
             git

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli

RUN docker-php-ext-install pgsql \
  && docker-php-ext-install pdo_pgsql \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl \
  && docker-php-ext-install zip \
  && docker-php-ext-install exif \
  && docker-php-ext-install opcache \
  && docker-php-ext-install sockets \
  && pecl install amqp \
  && docker-php-ext-enable amqp \
  && pecl install redis \
  && docker-php-ext-enable redis

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/*