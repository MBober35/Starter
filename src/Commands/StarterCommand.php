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
                    { --frontend : Without refactor frontend files }
                    { --layouts : Without refactor layouts files }
                    { --auth : Without install authentication UI scaffolding }';

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
            ! $this->option("frontend") &&
            $this->confirm("It's refactor frontend files, are you shure?")
        ) {
            $this->initFrontEnd();
        }

        if (
            ! $this->option("layouts") &&
            $this->confirm("It's refactor layouts files, are you shure?")
        ) {
            $this->initLayouts();
        }

        if (
            ! $this->option("auth") &&
            $this->confirm("It's refactor auth scaffoldind, are you shure?")
        ) {
            $this->initAuth();
        }
    }
}
