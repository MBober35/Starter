<?php

namespace MBober35\Starter\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MBober35\Starter\Facades\LoginGenerator;

class EmailAuthController extends Controller
{
    public function auth(string $email, string $token)
    {
        if (Auth::check()) Auth::logout();
        $result = LoginGenerator::tryLoginUser($token, $email);
        if ($result["success"]) {
            return redirect()
                ->route("login");
        }
        else {
            return redirect()
                ->route("login")
                ->with("danger", $result["message"]);
        }
    }
}
