<?php

namespace MBober35\Starter\Commands;

use Illuminate\Filesystem\Filesystem;

trait LayoutsScaffolding
{
    /**
     * Сгенерировать файлы layouts.
     */
    protected function initLayouts()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));

        (new Filesystem)->copyDirectory(__DIR__ . '/Stubs/views/layouts', resource_path('views/layouts'));

        $this->info('Layouts files created succesfully!');
    }
}