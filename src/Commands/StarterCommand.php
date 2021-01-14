<?php

namespace MBober35\Starter\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StarterCommand extends Command
{
    use LayoutsScaffolding, FrontEndScaffolding, AuthScaffolding;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starter
                    { --no-frontend : Without refactor frontend files }
                    { --no-layouts : Without refactor layouts files }
                    { --no-auth : Without install authentication UI scaffolding }';

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
        if (
            ! $this->option("no-frontend") &&
            $this->confirm("It's refactor frontend files, are you shure?")
        ) {
            $this->initFrontEnd();
        }

        if (
            ! $this->option("no-layouts") &&
            $this->confirm("It's refactor layouts files, are you shure?")
        ) {
            $this->initLayouts();
        }

        if (
            ! $this->option("no-auth") &&
            $this->confirm("It's refactor auth scaffoldind, are you shure?")
        ) {
            $this->initAuth();
        }
    }
}
