# Atrium Campus Interview Project

## TODO
- Tests
- Pagination of returned loans

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

## CodeIgniter Features I Used
- Migrations
- Seeders
- Fabricators
- MVC
