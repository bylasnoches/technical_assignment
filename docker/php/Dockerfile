FROM php:8.2-fpm

ARG USER_NAME
ARG USER_ID

# Install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends locales tzdata \
    && locale-gen en_US.UTF-8

RUN rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        software-properties-common \
        gettext \
        libonig-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        libpng-dev \
        libjpeg-dev \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        libxml2-dev \
        libsqlite3-dev \
        libxslt-dev \
        libssh2-1-dev \
        libssh2-1 \
        wget \
        curl \
        git \
        vim \
        zip \
        unzip

RUN ln -sf /dev/stderr /var/log/php-fpm.log \
    && apt-get clean \
    && rm -rf /tmp/* /var/tmp/* /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install \
        bcmath \
        ctype \
        dom \
        exif \
        gd \
        gettext \
        intl \
        mbstring \
        opcache \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        pdo_sqlite \
        simplexml \
        xml \
        xsl \
        zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin
RUN export PATH="~/.composer/vendor/bin/:$PATH"

COPY php.ini /usr/local/etc/php/conf.d/

RUN rm /usr/local/etc/php-fpm.d/www.conf
COPY www.conf /usr/local/etc/php-fpm.d/

ADD entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN set -eux; \
    useradd --uid ${USER_ID} --shell /bin/bash --create-home ${USER_NAME}; \
# allow running as an arbitrary user (https://github.com/docker-library/php/issues/743)
    [ ! -d /var/www/currency-exchange ]; mkdir -p /var/www/currency-exchange; \
    chown -Rf ${USER_NAME}:${USER_NAME} /var/www; \
    chmod 777 -R /tmp; chmod o+t -R /tmp; \
    sed -i "s/www-data/${USER_NAME}/g" /usr/local/etc/php-fpm.d/www.conf

USER ${USER_NAME}

# Set working directory
WORKDIR /var/www/currency-exchange

# Set the default command to run PHP-FPM
CMD ["php-fpm"]
