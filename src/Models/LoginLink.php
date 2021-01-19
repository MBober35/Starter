<?php

namespace MBober35\Starter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use MBober35\Starter\Notifications\SendLoginLink;

class LoginLink extends Model
{
    use HasFactory, Notifiable;

    protected $keyType = "string";
    public $incrementing = false;
    protected $primaryKey = "email";

    protected $fillable = [
        "email",
        "token",
        "send",
    ];

    protected static function booted()
    {
        parent::booted();

        static::created(function (self $link) {
            if (! empty($link->send)) {
                $link->notify(new SendLoginLink($link));
            }
        });
    }
}
