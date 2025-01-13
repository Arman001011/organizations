<?php

use App\Http\Controllers\Api\OrganizationController;
use App\Http\Middleware\ApiStaticKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiStaticKeyMiddleware::class])->group(function () {
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show']);
});
