<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('hello', function () {
    return response()->json([
        'message' => 'hello world!'
    ]);
});
