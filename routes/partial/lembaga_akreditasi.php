<?php

use App\Http\Controllers\LembagaAkreditasiController;
use Illuminate\Support\Facades\Route;

$main_url = 'lembaga-akreditasi';

Route::get('/'.$main_url.'/lembagaakreditasibyidjson/{id}', [LembagaAkreditasiController::class, 'lembagaakreditasibyidjson'])->name($main_url.'.getById');
Route::get('/'.$main_url.'/lembagaakreditasijson', [LembagaAkreditasiController::class, 'lembagaakreditasijson']);
Route::resource($main_url, LembagaAkreditasiController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

