<?php

use App\Http\Controllers\Api\TestController;
use App\Http\Middleware\ApiStaticKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiStaticKeyMiddleware::class])->group(function () {
    Route::get('/test', [TestController::class, 'index']);
});
