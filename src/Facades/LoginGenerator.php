<?php

namespace MBober35\Starter\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Facade;
use MBober35\Starter\Helpers\LoginGeneratorManager;
use MBober35\Starter\Models\LoginLink;

/**
 * @method static LoginLink generateLink(User $user, $send)
 * @method static string getUrl(LoginLink $link)
 * @method static array tryLoginUser(string $token, string $email)
 *
 * @see LoginGeneratorManager
 */
class LoginGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "login-generator";
    }
}