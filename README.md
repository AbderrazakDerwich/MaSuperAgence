# MaSuperAgence

## Introduction
this project represents a website for the management of a real estate agency, 
composed of a used interface allowing consultation of the lists of existing properties and an admin interface to manage the site

## Installation

### DataBase initialization

On first set-up,`run bin/console doctrine:database:create.`   
second run `php bin/console doctrine:schema:update`  

## Configure environment variables

All environment variables are present in .env file. They must be configured depending on the targeted environment (local, int, uat, preprod or prod) and should be identical for all the php instances of a same environment.

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=397f6f617e5b1734dacf861ff62ceb49
###< symfony/framework-bundle ###

###> symfony/mailer ###
MAILER_DSN=smtp://localhost
###< symfony/mailer ###

###> doctrine/doctrine-bundle ###
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
###< doctrine/doctrine-bundle ###

### Cache and vendors

Run composer install to install the vendors and build the cache.
