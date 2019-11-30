FROM 038855593698.dkr.ecr.eu-west-1.amazonaws.com/beep-php-production:b1e31c2 as api-prod

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY composer.json composer.lock symfony.lock ./

RUN set -eux; \
	composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest; \
	composer clear-cache

COPY bin bin/
COPY config config/
COPY public public/
COPY src src/
COPY .env ./

RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	composer run-script --no-dev post-install-cmd; \
	chmod +x bin/console; sync

CMD ["php-fpm"]
