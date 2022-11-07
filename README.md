Project Description

This is a simple project that allows login users to top up their subscription

Project Limitation

The project is still under development. Hence it only accepts stripes and paystack in test mode

Project Technology

Project TechnologyThe project is designing using

Html

Php

Laravel 9

Css

Sass

Bootstrap 5.0

Project Requirement

To run this project you need

Php 8.1

Mysql

Apache server or any other server

How to set up project Clone the project

Rename .env.example to .env Create a database using the name specific in the .env file Run the following command command

1.composer update

Clone the project

Rename .env.example to .env

Create a database using the name specific in the .env file

Run the following command command

composer update

composer install

php artisan migrate

php artisan db:seed --class=PlanTableSeeder

How to use the project

php artisan serve
npm run dev
open the link generated in step 1
register and login
click on add subscription
make payment using either paystack or stripe.
Note you can only use the default choosen card for payment. However their is an option to change it
