# Installation

To install the project with Docker please make sure you have installed it on your working machine.

- **Docker**: [Install Docker](https://docs.docker.com/get-docker/)
- **Docker Compose**: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Clone the repo
`cd <your-projects-directory>`

`git clone https://github.com/Arman001011/organizations.git`

`cd organizations`

## Create .env file and then edit it to configure database settings and other environment-specific variables

`cp .env.example .env`

## Build the Docker images and start the containers for the Laravel app and MySQL database.

`docker-compose up --build -d`

## Enter the app container

`docker exec -it laravel_app bash`

## Install composer

`composer install`

## Run migrations

`php artisan migrate`

## Run seeders

`php artisan db:seed`

## Make storage accessible

`php artisan storage:link`

# Now the app will be available at http://localhost:8080. And API documentation will be visible at http://localhost:8080/api/documentation. 

### If you need to stop the containers, you can run `docker-compose down` and run `docker-compose up -d` to restart them. Artisan commands can be run from outside of containers like `docker exec -it laravel_app php artisan migrate`.
