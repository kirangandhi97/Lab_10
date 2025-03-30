<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WellController;

Route::get('/', function () {
    return redirect()->route('wells.index');
});

Route::resource('wells', WellController::class);
