FROM webdevops/php-nginx:7.4-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
COPY . /app
RUN composer1 install -d /app
RUN chmod -R 777 /app/storage/
