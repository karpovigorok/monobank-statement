# Monobank Statement

## About

Додаток до Laravel 5.5 дозволяє отримати виписку по вашим рахункам [Monobank](https://www.monobank.ua/) за допомогою [API](https://api.monobank.ua/docs/) для розробників, що предоставляє Monobank.

Цей код використовується на сайті https://www.fintechband.com.ua

Для отримання виписки введіть токен. Можете отримати в особистому кабінеті https://api.monobank.ua/

Виписка генерується за унікальним посиланням, яке знаєте тільки ви, поширення посилання на виписку залишається на ваш розсуд.


Laravel 5.5 package allow to get Statement based on [Monobank API](https://api.monobank.ua/docs/)

This code using on website https://www.fintechband.com.ua

## How To

`
composer require karpovigorok/monobank-statement
php artisan vendor:publish
php artisan migrate
`
