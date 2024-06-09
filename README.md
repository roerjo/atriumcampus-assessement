# Atrium Campus Interview Project

## TODO
- Deletion confirmation modal
- Improve the table, e.g. sorting
- Pagination of returned loans
- Better error handling
- See if route model binding is a thing in CI
- See if validation could be performed like Laravel FormRequests
- Figure out odd issue with using PUT HTTP method in automated tests

## Getting Started Locally
### Prerequisites
- Docker
### Setup
1. Create a copy of `env` file named `.env`
2. Within `.env` set the `CI_ENVIRONMENT` variable to "development"
3. In a terminal, from the root of the project run `docker-compose up`
#### Create connection to local database
1. Open your favorite database client that can connect to MySQL databases
2. Create new connection using the following config:
   - Host: `mysql`
   - Port: `3306`
   - Username: `root`
   - Password: `secret`
3. Test the connection
#### Verify the application can be reached from your browser
Navigate to localhost:8888

#### Running tests
There are some basic tests in the `tests/feature/Controllers/` folder.

Create a testing database in the database container. I named mine `ci4_test`.

Setup up the test database credentials in your `.env` file. Here is what mine looks like:
```
database.tests.hostname = mysql
database.tests.database = ci4_test
database.tests.username = root
database.tests.password = secret
database.tests.DBDriver = MySQLi
database.tests.DBPrefix =
database.tests.charset = utf8mb4
database.tests.DBCollat = utf8mb4_general_ci
database.tests.port = 3306
```

To run all tests, use the following:
```sh
docker exec atriumcampus-web vendor/bin/phpunit
```
