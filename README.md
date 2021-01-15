# Starter

Подключение Bootstrap5, VueJs, Font Awesome, SweetAlert2. Создание основного шаблона для приложения. Создание контроллеторв и шаблонов для авторизации.

Front-end раздерен на две папки, `app` для основного сайта, `admin` для управления сайтом.

## Install

    composer require mbober35/starter
    php artisan starter

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
