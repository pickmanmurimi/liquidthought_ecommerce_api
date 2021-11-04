# Ecommerce API - Laravel, TDD

This is an api for the Liquid Shop project, (https://github.com/pickmanmurimi/liquidthought_ecommerce_frontend)

It is recommended that you set up the api first before moving on to the frontend, if you came here first, you are in the
right place.

Let's begin 😀.

## Requirements

- apache/Nginx
- php 8.^
- mysql:8.0
- sqlite
- Laravel dependencies and installation requirements are listed here, https://laravel.com/docs/8.x/installation

## Environment Setup

Well this is a very simple api instance, all you really need to do is to copy the `.env.example` file and 
paste it as `.env`.
You now just need to change the values for the following variables to match your environment.

    FRONTEND_URL=http://localhost:3000
    # you can use my default slack url https://hooks.slack.com/services/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
    # it basically enables me to moniot the app via slack for debug logs
    LOG_SLACK_WEBHOOK_URL=
    
    DB_DATABASE=liquid_thought_ecommerce_api
    DB_USERNAME=
    DB_PASSWORD=
    
    MAIL_USERNAME=
    MAIL_PASSWORD=

Proceed to create a database and add the details in the `DB_` section of the .env

TO confirm everything is running fine, just run.

    php artisan test

I wrote tests for the api, this if all is well, these should pass if your environment and `.env` was set up right.

Now run 

    php artisan db:seed

This will add dummy products to the database.

## Running the Project.

Well a Laravel project is quite easy to get running, You basically need to run `composer install`. 
Finally `php artisan serve`, in case you do not have virtual hosts configured on your pc.
It is recommended you run this using a development environment like laravel valet or laragon.
