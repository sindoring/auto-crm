<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Установка

Необходим PHP 7.2.5 и выше, NodeJS и Composer

- создать пустую базу данных
- composer install
- npm install
- php artisan migrate
- php artisan passport:install
- скопировать .env.example и переименовать в .env, заполнить данные APP_URL в соответствии с конфигурацией сервера
- не забыть указать путь к папке public как к корневому каталогу на стороне веб-сервера
- в .env заполнить данные о базе данных: название, логин и параль (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- php artisan key:generate
- php artisan cars:import '/cars.csv'
- php artisan admin:add '+7 (ХХХ) ХХХ-ХХ-ХХ' 'Ваш пароль' //Команда для добавления администратора, где X - цифры номера
- номер вводить в соответствии маске выше
- npm run dev

