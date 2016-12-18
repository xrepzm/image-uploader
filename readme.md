Edit Your own .env file with database settings, then follow the commands below.

Install Laravel
$ composer update

PHPUnit testing:
$ vendor\bin\phpunit

Postman/Ajax test:
$ php artisan migrate:refresh

In Postman create new POST request with [image-uploader.dev/api/upload-image] and in the Body section add a new key 'image', then choose the value's type file and find some image in your system - upload size is limited in laravel's request. You get the response.

It is a very simple setup, but as simple as is :)

[![Képernyőfelvétel (2).png](https://s23.postimg.org/4d91wxwvf/K_perny_felv_tel_2.png)](https://postimg.org/image/ulk6mbgyv/)
