<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

$main_url = 'profile';

Route::get('/'.$main_url, [ProfileController::class, 'index'])->name($main_url);

