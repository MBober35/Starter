# Starter

Подключение Bootstrap5, VueJs. Создание основного шаблона для приложения. Создание контроллеторв и шаблонов для авторизации.

## Install

    composer require mbober35/starter
    php artisan starter

### Подключение путей для авторизации

В `web.php` добавить `Route::auth()`

Параметры:
    
    login (true) - авторизация пользователй
    logout (true) - выход из приложения
    register (false) - регистрация пользователей
    reset (true) - восстановление пароля
    confirm (true если есть контроллер) - подтверждение пароля
    verify (false) - подтверждение e-mail

## Commands

    php artisan starter
                    { --no-frontend : Without refactor frontend files }
                    { --no-layouts : Without refactor layouts files }
                    { --no-auth : Without install authentication UI scaffolding }

Параметр `frontend` запускает команду без добавления Bootstrap и VueJs.

Пармерт `layouts` запускает команду без создания файла `app.blade.php`

Парметр `auth` запускает команду без создания контроллеров для авторизации.
