<?php

namespace MBober35\Starter\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

trait AuthScaffolding
{
    protected function initAuth()
    {
        $this->createControllers();
    }

    /**
     * Добавить контроллеры в приложение.
     */
    protected function createControllers()
    {
        $filesystem = new Filesystem;

        $filesystem->ensureDirectoryExists(app_path('Http/Controllers/Auth'));

        collect($filesystem->allFiles(__DIR__ . '/Stubs/Auth'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });

        $this->info('Authentication scaffolding generated successfully.');

        $this->createHomeController();
    }

    /**
     * Добавить главный контроллер.
     */
    protected function createHomeController()
    {
        $controller = app_path('Http/Controllers/HomeController.php');

        if (file_exists($controller)) {
            if ($this->confirm("The [HomeController.php] file already exists. Do you want to replace it?")) {
                file_put_contents($controller, $this->compileControllerStub());
            }
        } else {
            file_put_contents($controller, $this->compileControllerStub());
        }

        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/Stubs/routes.stub'),
            FILE_APPEND
        );
    }

    /**
     * Compiles the "HomeController" stub.
     *
     * @return string
     */
    protected function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->laravel->getNamespace(),
            file_get_contents(__DIR__ . '/Stubs/HomeController.stub')
        );
    }
}