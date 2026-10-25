<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {

    require __DIR__ . '/dashboard.php';
    require __DIR__ . '/customers.php';
    require __DIR__ . '/inspections.php';
    require __DIR__ . '/branches.php';
    require __DIR__ . '/administration.php';
    require __DIR__ . '/users.php';
    require __DIR__ . '/reports.php';
});

require __DIR__ . '/settings.php';
