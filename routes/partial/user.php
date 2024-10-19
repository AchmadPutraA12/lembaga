<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$main_url = 'user';

Route::get('/'.$main_url.'/userjson', [UserController::class, 'userjson']);
Route::resource($main_url, UserController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

