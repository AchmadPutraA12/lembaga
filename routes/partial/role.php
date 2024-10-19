<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

$main_url = 'role';

Route::get('/'.$main_url.'/rolejson', [RoleController::class, 'rolejson']);
Route::resource($main_url, RoleController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

