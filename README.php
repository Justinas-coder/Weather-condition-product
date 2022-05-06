
Stack:
- PHP 8.1.4
- Docker version 20.10.14
- Laravel 9.x



Build:

1 - Set up Docker service in your machine >> see  manuals link: https://docs.docker.com/

2 - Clone repository link: "git@github.com:Justinas-coder/Weather-condition-product.git"

3 -  Create .env file by running Cml command: "cp .env.example .env"

4 - Install PHP dependencies: composer install

5 - Use "$sail up -d" command in Cml.

When we run this, we should see output like this:

weather-condition_laravel.test_1   start-container   Exit 137
Shutting down old Sail processes...
Creating network "weather-condition_sail" with driver "bridge"
Creating weather-condition_meilisearch_1 ... done
Creating weather-condition_mysql_1       ... done
Creating weather-condition_selenium_1    ... done
Creating weather-condition_mailhog_1     ... done
Creating weather-condition_redis_1       ... done
Creating weather-condition_laravel.test_1 ... done

4 - Use "$sail php artisan migration" in Cml, and make database migrations

5 - Use "$sail php artisan db:seed "in Cml, and seed database tables

Know launch web browser with url link: http://localhost/api/products/recommendation/vilnius,

endpoint of url can be all Lithuanian main cities.



Application do:

depending on the city name in endpoint of url,

For the next 3 days depending on the forecast application returns

2 items that would match the weather forecast.

For forecast data was useed (external LHMT API: https://api.meteo.lt/).

Application returns Json format.


To run PHP uni test for API response use $sail php artisan test --filter test_api_respond

