<?php

namespace MBober35\Starter\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StarterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starter
                    { --all : Run all options }
                    { --frontend : Refactor frontend files }
                    { --layouts : Refactor layouts files }
                    { --auth : Install authentication UI scaffolding }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init front-end scaffolding';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all = $this->option("all", false);
        if (
            $all ||
            $this->option("frontend") &&
            $this->confirm("It's refactor frontend files, are you shure?")
        ) {
            $this->initFrontEnd();
        }

        if (
            $all ||
            $this->option("layouts") &&
            $this->confirm("It's refactor layouts files, are you shure?")
        ) {
            $this->initLayouts();
        }
        // TODO: auth option.
    }

    protected function initLayouts()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));

        (new Filesystem)->copyDirectory(__DIR__ . '/Stubs/views/layouts', resource_path('views/layouts'));

        $this->info('Layouts files created succesfully!');
    }

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
        copy(__DIR__ . '/Stubs/front-end/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/Stubs/front-end/script.js', resource_path('js/script.js'));
    }

    /**
     * Создать scss файлы.
     */
    protected static function updateScss()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('sass'));

        copy(__DIR__ . '/Stubs/front-end/_variables.scss', resource_path('sass/_variables.scss'));
        copy(__DIR__ . '/Stubs/front-end/app.scss', resource_path('sass/app.scss'));
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
