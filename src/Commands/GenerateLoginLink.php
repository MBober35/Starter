<?php

namespace MBober35\Starter\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use MBober35\Starter\Facades\LoginGenerator;

class GenerateLoginLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-link {email} {--send=} {--get}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate link for single login to site';

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
        $email = $this->argument("email");
        $send = $this->option("send");
        if ($this->option("get", false)) {
            $send = null;
        }
        elseif (empty($send)) {
            $send = $email;
        }

        try {
            $user = User::query()
                ->where("email", $email)
                ->firstOrFail();
            $link = LoginGenerator::generateLink($user, $send);
            $url = LoginGenerator::getUrl($link);
            $this->info("Link generated {$url}");
        }
        catch (\Exception $exception) {
            $this->error("User not found");
        }
    }
}
