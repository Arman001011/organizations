<?php

use App\Http\Controllers\Api\OrganizationController;
use App\Http\Middleware\ApiStaticKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiStaticKeyMiddleware::class])->group(function () {
    Route::resource('organizations', OrganizationController::class)->only([
        'index', 'show',
    ]);
});
