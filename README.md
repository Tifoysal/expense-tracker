<p align="center">


## About ``Unison ERP``

# How to run
#### First clone the repo. To do that open your terminal and run bellow code

``if you use SSH ``
> git clone origin git@github.com:kodeeo/Unison-backend.git


``if you use HTTPS ``
> git clone origin https://github.com/kodeeo/Unison-backend.git

#### Run the composer command to get all the packages with into vendor directory
> composer install

#### Create `` .env `` file from `` .env.example ``. To do that go to project directory and run

>  cp .env.example .env

#### Generate app key

>  php artisan key:generate


#### Changes the database configuration in `` .env `` file

>DB_DATABASE=your_database_name

>DB_USERNAME=root

>DB_PASSWORD=



#### Run the migration command to get all the table into your database
> php artisan migrate

#### Run the seeder to get test data into the table(s)
> php artisan permission:init

#### Run the seeder to get test data into the table(s)
> php artisan db:seed

#### Run the jwt secret to generate secret for API authentication
> php artisan jwt:secret

#### Finally, Run the command to get the Bangladesh geo-location data
> php artisan BangladeshGeocode:setup
