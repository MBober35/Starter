<?php

namespace MBober35\Starter\Commands;

use Illuminate\Filesystem\Filesystem;

trait FrontEndScaffolding
{
    /**
     * Сгенерировать front-end фалы, добавить библиотеки.
     */
    protected function initFrontEnd()
    {
        // NPM Packages.
        static::updateNodePackages(function ($packages) {
            return [
                    "bootstrap" => "^5.0.0-beta1",
                    "jquery" => "^3.5.1",
                    "@popperjs/core" => "^2.6.0",
                    "sass" => "^1.32.4",
                    "sass-loader" => "^10.1.1",
                    "resolve-url-loader" => "^3.1.2",
                    "vue" => "^2.6.12",
                    "vue-template-compiler" => "^2.6.12",
                    "@fortawesome/fontawesome-free" => "^5.15.2",
                    "sweetalert2" => "^10.13.0",
                ] + $packages;
        });
        static::updateWebpackFile();
        static::updateScss();
        static::updateBootstrapping();
        static::createExampleComponent();
        if ($this->confirm("Remove node_modules folder?")) {
            static::removeNodeModules();
        }


        $this->info("Bootstrap & Vue installed successfully!");
        $this->comment("Now need to run 'npm install && npm run dev' to compile.");
    }

    /**
     * Удалить ранее установленные модули.
     */
    protected static function removeNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));
            $files->delete(base_path('yarn.lock'));
        });
    }

    /**
     * Добавить пример компонента.
     */
    protected static function createExampleComponent()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('js/components'));

        copy(
            __DIR__ . '/Stubs/front-end/ExampleComponent.vue',
            resource_path('js/components/ExampleComponent.vue')
        );
    }

    /**
     * Обновить файл загрузки.
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__ . '/Stubs/front-end/bootstrap.js', resource_path('js/bootstrap.js'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/app'));
        copy(__DIR__ . '/Stubs/front-end/app.js', resource_path('js/app/app.js'));
        copy(__DIR__ . '/Stubs/front-end/script.js', resource_path('js/app/script.js'));
        copy(__DIR__ . '/Stubs/front-end/empty.js', resource_path('js/app/vue-includes.js'));
        copy(__DIR__ . '/Stubs/front-end/empty.js', resource_path('js/app/script-includes.js'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js/admin'));
        copy(__DIR__ . '/Stubs/front-end/app.js', resource_path('js/admin/admin.js'));
        copy(__DIR__ . '/Stubs/front-end/script.js', resource_path('js/admin/script.js'));
        copy(__DIR__ . '/Stubs/front-end/empty.js', resource_path('js/admin/vue-includes.js'));
        copy(__DIR__ . '/Stubs/front-end/empty.js', resource_path('js/admin/script-includes.js'));
    }

    /**
     * Создать scss файлы.
     */
    protected static function updateScss()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('sass/app'));
        copy(__DIR__ . '/Stubs/front-end/app.scss', resource_path('sass/app/app.scss'));
        copy(__DIR__ . '/Stubs/front-end/_variables.scss', resource_path('sass/app/_variables.scss'));
        copy(__DIR__ . '/Stubs/front-end/_empty.scss', resource_path('sass/app/_includes.scss'));

        (new Filesystem)->ensureDirectoryExists(resource_path('sass/admin'));
        copy(__DIR__ . '/Stubs/front-end/app.scss', resource_path('sass/admin/admin.scss'));
        copy(__DIR__ . '/Stubs/front-end/_variables.scss', resource_path('sass/admin/_variables.scss'));
        copy(__DIR__ . '/Stubs/front-end/_empty.scss', resource_path('sass/admin/_includes.scss'));
    }

    /**
     * Перезаписать файл webpack.
     */
    protected static function updateWebpackFile()
    {
        copy(__DIR__.'/Stubs/front-end/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Обновить файл package.json
     *
     * @param bool $dev
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path("package.json"))) return;

        $configurationKey = $dev ? "devDependencies" : "dependencies";

        $packages = json_decode(file_get_contents(base_path("package.json")), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path("package.json"),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}