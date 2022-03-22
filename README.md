# Starter

Подключение Bootstrap5, VueJs, Font Awesome, SweetAlert2. Создание основного шаблона для приложения. Создание контроллеторв и шаблонов для авторизации.

Front-end раздерен на две папки, `app` для основного сайта, `admin` для управления сайтом.

Для управления сайтом можно скачать и добавить тему [AdminKit](https://github.com/adminkit/adminkit), под нее созданы шаблоны `admin-kit`

Что бы поменять тему, нужно добавить/заменить в `webpack` js и scss файлы для `admin-kit`; скопировать js и scss файлы темы в `resources/themes/adminkit/src`; шрифты скопировать в `public`; в `admin\layouts` заменить admin на admin-kit;

Если используется пакет [Helpers](https://packagist.org/packages/mbober35/helpers), для структуры меню, в конфиге поменять `"adminLeftMenu" => "helpers::includes.admin-kit-menu"`

Публикация шаблонов: `php artisan vendor:publish --provider="MBober35\Starter\ServiceProvider" --tag=views`

## Install

    composer require mbober35/starter
    php artisan migrate
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

    login-link {email} {--send=} {--get}

Сгенерировать одрозовую ссылку на вход
