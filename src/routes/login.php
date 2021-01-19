<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "middleware" => ["web"],
], function () {
    Route::get("email-authenticate/{email}/{token}", [\MBober35\Starter\Controllers\EmailAuthController::class, "auth"])
        ->name("email-authenticate");
});