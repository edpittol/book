FROM php:8.4-alpine

RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
	&& apk add bash chromium curl chromium-chromedriver git icu-dev libzip-dev linux-headers patch \
	&& pecl install apcu pcov xdebug \
	&& docker-php-ext-enable apcu pcov xdebug \
	&& docker-php-ext-install intl mysqli zip \
	&& pecl clear-cache \
	&& apk del .build-dependencies 

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash \
	&& mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN { \
	echo 'xdebug.mode = ${XDEBUG_MODE}'; \
	echo 'xdebug.start_with_request = yes'; \
	echo 'xdebug.client_host = 172.17.0.1'; \
	echo 'xdebug.log = /tmp/xdebug.log'; \
} > /usr/local/etc/php/conf.d/xdebug.ini

RUN { \
	echo 'error_reporting = E_ALL & ~E_DEPRECATED'; \
} > /usr/local/etc/php/conf.d/php-override.ini

COPY server-entrypoint.sh /usr/local/bin/server-entrypoint.sh
