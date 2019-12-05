FROM 038855593698.dkr.ecr.eu-west-1.amazonaws.com/beep-php-development:b1e31c2 as api-dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

COPY composer.json composer.lock symfony.lock ./

RUN set -eux; \
	composer install --prefer-dist --no-progress --no-suggest --no-interaction --no-scripts; \
	composer clear-cache

COPY bin bin/
COPY config config/
COPY public public/
COPY src src/
COPY templates templates/
COPY tests tests/
COPY .env ./
COPY .env.test ./
COPY phpunit.xml.dist .
