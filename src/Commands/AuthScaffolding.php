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
    }
}