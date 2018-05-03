# IMMO\VR (with Laravel PHP Framework 5.2)

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)


IMMO\VR is a website develloped to export easily 360° photo/video and create simple expose experience.

![alt text](https://github.com/rim31/22-laravel-php/blob/master/storage/1.png)

![alt text](https://github.com/rim31/22-laravel-php/blob/master/storage/2.png)

![alt text](https://github.com/rim31/22-laravel-php/blob/master/storage/3.png)

![alt text](https://github.com/rim31/22-laravel-php/blob/master/storage/4.png)

![alt text](https://github.com/rim31/22-laravel-php/blob/master/storage/6.png)


## Official installation

you need php, composer, laravel, mysql
(https://getcomposer.org/download/)


exemple creation of a projet laravel :

```
composer create-project --prefer-dist laravel/laravel immo-vr "5.2.*"
```

First of all, check the file :

```
.env
```


Then, in a terminal :

**Install vendor
**
```
composer install
```

or update
```
composer update
```

**First installation database : 
**(drop the table 'myvr', if any problem then execute this command)
```
php artisan migrate
```

delete database :

```
php artisan migrate:rollback
```
reinitialize database


```
php artisan migrate:refresh
```

<!> not necessary in production(reinitialize DB and install admin22 session test) <!>
```
php artisan migrate:refresh --seed
```
without reinstalling database, just install admin22 session test :
```
php artisan db:seed
```

These will set databases :
user, join_user_exp, exp, join_exp_photo, photo, join_photo_hotspot, hotspot, (historypayment)

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

to see route redirections :

```
php artisan route:list
```


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
