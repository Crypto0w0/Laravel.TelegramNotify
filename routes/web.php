<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

Route::get('/admin', function () {
    if (Gate::allows('access-admin-panel')) return 'Welcome to admin panel!';
    abort(403);
})->middleware(['auth']);

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
