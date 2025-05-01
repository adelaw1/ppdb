<?php

use App\Http\Controllers\PdbController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PdbController::class)->group(function () {
    Route::prefix('/ppdb')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'save_formulir');
    });
});
