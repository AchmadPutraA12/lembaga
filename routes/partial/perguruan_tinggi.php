<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

$main_url = 'perguruan-tinggi';

Route::get('/'.$main_url.'/perguruantinggibyidjson/{id}', [OrganizationController::class, 'perguruantinggibyidjson'])->name($main_url.'.getPTById');
Route::get('/'.$main_url.'/perguruantinggibyidbpjson/{id_bp}', [OrganizationController::class, 'perguruantinggibyidbpjson'])->name($main_url.'.getPTByIdBP');
Route::get('/'.$main_url.'/perguruantinggidefault', [OrganizationController::class, 'perguruantinggidefault'])->name($main_url.'.default');
Route::get('/'.$main_url.'/perguruantinggijson', [OrganizationController::class, 'perguruantinggijson'])->name($main_url.'.ptjson');
Route::resource($main_url, OrganizationController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

