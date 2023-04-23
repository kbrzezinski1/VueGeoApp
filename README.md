# VueGeoApp
This project requires Docker and Composer to be installed.

1. Clone the repository to your local machine: git clone https://github.com/kbrzezinski1/VueGeoApp.git
2. Change into the project directory: cd VueGeoApp
3. Run the following command to start the application: docker compose up -d
4. Install the required dependencies to run tests using Composer: docker compose exec php composer install -d /var/www/api
5. To run the tests for this project, use the following command: docker compose exec php ./api/vendor/bin/phpunit ./api/tests
