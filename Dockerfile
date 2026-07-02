FROM node:20-alpine AS node

FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN npm ci --ignore-scripts && npm run build

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

COPY nginx.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8080

CMD php-fpm -D && nginx -g 'daemon off;'
