<?php

namespace MBober35\Starter\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use MBober35\Starter\Models\LoginLink;

class LoginGeneratorManager
{
    /**
     * Сформировать ссылку.
     *
     * @param User $user
     * @param null|string $send
     * @return LoginLink|mixed
     */
    public function generateLink(User $user, $send)
    {
        $link = $this->checkUserLink($user);
        if ($link) {
            $link->delete();
        }
        $link = $this->createLink($user, $send);
        return $link;
    }

    /**
     * Получить ссылку.
     *
     * @param LoginLink $link
     * @return string
     */
    public function getUrl(LoginLink $link)
    {
        $email = $link->email;
        $token = $link->token;
        return route("email-authenticate", compact("email", "token"));
    }

    /**
     * Попробовать авторизовать пользователя.
     *
     * @param string $token
     * @param string $email
     * @return array
     * @throws \Exception
     */
    public function tryLoginUser(string $token, string $email)
    {
        $link = LoginLink::query()
            ->where("token", $token)
            ->where("email", $email)
            ->first();
        if (empty($link)) return [
            "success" => false,
            "message" => "Некорректная ссылка",
        ];
        $link->delete();
        if ($link->created_at < Carbon::parse("-30 minutes")) return [
            "success" => false,
            "message" => "Ссылка устарела",
        ];

        $user = User::query()
            ->where("email", $email)
            ->first();
        if (empty($user)) return [
            "success" => false,
            "message" => "Пользователь не найден",
        ];
        /**
         * @var User $user
         */
        Auth::login($user);
        return [
            "success" => true,
            "message" => "Вход выполнен",
        ];
    }

    /**
     * Создать ссылку.
     *
     * @param User $user
     * @return mixed
     */
    protected function createLink(User $user, $send)
    {
        return LoginLink::create([
            "email" => $user->email,
            "token" => $this->getToken(),
            "send" => $send,
        ]);
    }

    /**
     * Получить токен.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    protected function getToken()
    {
        return Str::uuid();
    }

    /**
     * Проверить текущие ссылки.
     *
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    protected function checkUserLink(User $user)
    {
        return LoginLink::query()
            ->where("email", $user->email)
            ->first();
    }
}