FROM php:7.4-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

# Install Node.js 
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get install --yes nodejs
RUN node -v
RUN npm -v
RUN npm install -g concurrently
RUN concurrently -v

WORKDIR /app
COPY . /app

# Install project dependencies
RUN composer install
RUN npm install

EXPOSE 8000
# run the project
CMD concurrently "npm run watch-poll" "php artisan serve --host=0.0.0.0 --port=8000"