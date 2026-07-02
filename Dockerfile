FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx postgresql-dev nodejs npm && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev && \
    npm ci --ignore-scripts && npm run build

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

RUN mkdir -p /etc/nginx/http.d
COPY nginx.conf /etc/nginx/http.d/default.conf

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8080

CMD php-fpm -D && nginx -g 'daemon off;'
