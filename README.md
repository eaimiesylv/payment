**Project Description**

This is a simple project that allows login users to top up their subscription

**Project Limitation**

The project is still under development. Hence it only accepts stripes and paystack in test mode

**Project Technology**
The project is designing using

Html

Php

Laravel 9

Css

Sass

Bootstrap 5.0


**Project Requirement**

To run this project you need 

Php 8.1

Mysql

Apache server or any other server


**How to set up project**
Clone the project 

Rename .env.example to .env
Create a database using the name specific in the .env file
Run the following command command

1.composer update

2. composer install

3. php artisan migrate

4. php artisan db:seed --class=PlanTableSeeder

**How to use the project**
1. php artisan serve
2. npm run dev
3. open the link generated in step 1
4. register and login
5. click on add subscription
6. make payment using either paystack or stripe.
7. **Note you can only use the default choosen card for payment. However their is an option to change it**




