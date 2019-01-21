

## Converter

A small and easy-to-use converter tool from CSV to JSON and pre-formated HTML. 

## Pre-Requisites

    - Debian linux like
    - Php >= 7.2.x
    - curl >= 7.58.x
    - MySQL >= 5.7
    - Apache >= 2.4.x
    - Composer
    - git

## Install 

    git clone http://github.com/leandroqa/converter 
    
    or extract the application tar -xzvf converter-leandro_roberto.tgz
    
    
    cd converter

    composer update

    composer install
    
    cp .env.example .env

    *Edit the .env with your mysql credentials*

    php artisan key:generate

    chmod -R 775 public/files

    php artisan migrate


## Unit Tests

    cd converter

    vendor/bin/phpunit

## Running the application

    cd converter

    php artisan serve

## Extra

    - Method "convertTo($format)" from Class Convert, prepared to be extended to other formats
    - The config/filesystems.php can be easily changed to use aws s3
    - Class UploadController has a method destroyFile($file) ready to destroy the file uploaded in order to keep the system clean
    - The FormatFile class is prepared to format all fields

## About

    Designed and coded by Leandro A. Roberto

## License

The software is free to use. Enjoy it!
