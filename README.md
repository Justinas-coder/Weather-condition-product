### Application do:

depending on the city name in endpoint of url,
For the next 3 days depending on the forecast application returns
2 items that would match the weather forecast.
For forecast data was useed (external LHMT API: https://api.meteo.lt/).
Application returns Json format.


### Stack:

- PHP 8.1.4
- Docker version 20.10.14
- Laravel 9.x


### How to launch it:

1. Deppending on your OS (win, Ubuntu, Mac) make your system ready to use (https://www.docker.com).

2. Clone this repo
```
   git clone https://github.com/Justinas-coder/Weather-condition-product
```
3. Create .env file
```
   cp .env.example .env
```
4. Install PHP dependencies (reference: https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects)
```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
5. Start containers
```
    ./vendor/bin/sail up -d
```
6. Generate app encryption key
```
./vendor/bin/sail artisan key:generate
```
7. Make migrations using CML command
```
./vendor/bin/sail artisan migrate
```
8. Seed database using CML command.
```
./vendor/bin/sail artisan db:seed
```
9. Launch web browser with url:
```
 http://localhost/api/products/recommendation/vilnius,
```

endpoint of url can be all Lithuanian main cities.

#### To run PHP uni test for API response use:
```
php artisan test --filter test_api_respond
```

