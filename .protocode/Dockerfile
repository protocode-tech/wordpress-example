# Made with Protocode
# Generated on 2025-03-07 at 09:15:22

FROM debian:bullseye-slim 

ENV DEBIAN_FRONTEND="noninteractive" \
    PHP_VERSION=8.1 \
    COMPOSER_VERSION=2.5.1

ENV PHP_CONF_DIR=/etc/php/$PHP_VERSION \
    PHP_INI_FILE=/etc/php/$PHP_VERSION/cli/php.ini \
    FPM_INI_FILE=/etc/php/$PHP_VERSION/fpm/php.ini \
    APACHE_CONFDIR=/etc/apache2 \
    APACHE_ENVVARS=/etc/apache2/envvars \
    APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
    APACHE_RUN_DIR=/var/run/apache2 \
    APACHE_LOG_DIR=/var/log/apache2 \
    APACHE_PID_FILE=/var/run/apache2/apache2.pid \
    USER_ID=1000 \
    GROUP_ID=1000

RUN buildDeps='wget gcc make autoconf libc-dev zlib1g-dev pkg-config' \
    && set -x \
    # Install base deps
    && apt-get update \
    && apt-get install --no-install-recommends $buildDeps --no-install-suggests -q -y \
        gnupg2 dirmngr apt-transport-https lsb-release ca-certificates \
    # Update internal php deps references
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && apt-get update \
    # Install php and extensions
    && apt-get install --no-install-recommends --no-install-suggests -q -y \
        apt-utils \
        python3-pip python-setuptools \
        libmemcached-dev libmemcached11 \
        libmagickwand-dev \
        zip unzip \
        curl \
        php${PHP_VERSION} \
        php${PHP_VERSION}-fpm php${PHP_VERSION}-cli php${PHP_VERSION}-bcmath php${PHP_VERSION}-dev php${PHP_VERSION}-common php${PHP_VERSION}-opcache php${PHP_VERSION}-readline \
        php${PHP_VERSION}-mbstring php${PHP_VERSION}-curl php${PHP_VERSION}-gd php${PHP_VERSION}-imagick php${PHP_VERSION}-mysql php${PHP_VERSION}-zip php${PHP_VERSION}-pgsql \
        php${PHP_VERSION}-intl php${PHP_VERSION}-xml php${PHP_VERSION}-redis php${PHP_VERSION}-exif \
        php-pear \
    && if [ "${PHP_VERSION}" < "8.0" ]; then \
        apt-get install --no-install-recommends --no-install-suggests -q -y \
            php${PHP_VERSION}-json; \
    fi \
    && pecl -d php_suffix=${PHP_VERSION} install -o -f memcached \
    && mkdir -p /run/php \
    # Configure php and fpm
    && sed -i ${PHP_INI_FILE} \
        -e "s/display_errors\s*=\s*.*/display_errors = On/g" \
        -e "s/display_startup_errors\s*=\s*.*/display_startup_errors = On/g" \
        -e "s/error_reporting\s*=\s*.*/error_reporting = E_ALL/g" \
        -e "s/memory_limit\s*=\s*.*/memory_limit = 128M/g" \
        -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 25M/g" \
        -e "s/post_max_size\s*=\s*8M/post_max_size = 25M/g" \
    && sed -i ${FPM_INI_FILE} \
        -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" \
        -e "s/^;clear_env = no$/clear_env = no/" \ 
    && sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" ${PHP_CONF_DIR}/fpm/php-fpm.conf \
    # Configure redis
    && echo "extension=redis.so" > ${PHP_CONF_DIR}/mods-available/redis.ini \
    && ln -sf ${PHP_CONF_DIR}/mods-available/redis.ini ${PHP_CONF_DIR}/fpm/conf.d/20-redis.ini \
    && ln -sf ${PHP_CONF_DIR}/mods-available/redis.ini ${PHP_CONF_DIR}/cli/conf.d/20-redis.ini \
    # Configure memcache
    && echo "extension=memcached.so" > ${PHP_CONF_DIR}/mods-available/memcached.ini \
    && ln -sf ${PHP_CONF_DIR}/mods-available/memcached.ini ${PHP_CONF_DIR}/fpm/conf.d/20-memcached.ini \
    && ln -sf ${PHP_CONF_DIR}/mods-available/memcached.ini ${PHP_CONF_DIR}/cli/conf.d/20-memcached.ini \
    # Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} \
    # Install apache
    && apt-get install --no-install-recommends --no-install-suggests -q -y \
        apache2 libapache2-mod-php${PHP_VERSION} \
    # Framework specific
    && composer global require wp-cli/wp-cli \
    # Configure apache
    && a2dismod mpm_event && a2enmod mpm_prefork && a2enmod php${PHP_VERSION} && a2enmod rewrite && a2enmod headers \
        # Apache conf
        . "$APACHE_ENVVARS"; \
        for dir in "$APACHE_LOCK_DIR" "$APACHE_RUN_DIR" "$APACHE_LOG_DIR"; do \
            rm -rvf "$dir"; \
            mkdir -p "$dir"; \
            chown "$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$dir"; \
        done; \
        # delete the "index.html" that installing Apache drops in here
        rm -rvf /var/www/html/*; \
        ln -sfT /dev/stderr "$APACHE_LOG_DIR/error.log"; \
        ln -sfT /dev/stdout "$APACHE_LOG_DIR/access.log"; \
        ln -sfT /dev/stdout "$APACHE_LOG_DIR/other_vhosts_access.log"; \
        # logs should go to stdout / stderr
        chown -R --no-dereference "$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$APACHE_LOG_DIR"; \
        \
        { \
            echo '<FilesMatch \.php$>'; \
            echo    '\tSetHandler application/x-httpd-php'; \
            echo '</FilesMatch>'; \
            echo; \
            echo 'DirectoryIndex disabled'; \
            echo 'DirectoryIndex index.php index.html'; \
            echo 'SetEnv HTTPS on'; \
            echo; \
            echo '<Directory /var/www/html/>'; \
            echo    '\tOptions -Indexes'; \
            echo    '\tAllowOverride All'; \
            echo '</Directory>'; \
        } | tee "$APACHE_CONFDIR/conf-available/docker-php.conf" \
        && a2enconf docker-php \
    # Create base folder
    && mkdir -p /var/www/html \
    # Change www-data user and group id to 1000
    && usermod -u $USER_ID www-data && groupmod -g $GROUP_ID www-data \
    && chown -R www-data:www-data /var/www/html \
    # Clean up
    && rm -rf /tmp/pear \
    && apt-get purge -y --auto-remove $buildDeps \
    && apt-get clean \
    && apt-get autoremove \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2", "-D", "FOREGROUND"]
