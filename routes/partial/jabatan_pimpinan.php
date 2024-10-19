<?php

use App\Http\Controllers\JabatanController;
use Illuminate\Support\Facades\Route;

$main_url = 'jabatan-pimpinan';

Route::get('/'.$main_url.'/jabatanbyidjson/{id}', [JabatanController::class, 'jabatanbyidjson'])->name($main_url.'.getById');
Route::get('/'.$main_url.'/jabatanjson', [JabatanController::class, 'jabatanjson']);
Route::resource($main_url, JabatanController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

