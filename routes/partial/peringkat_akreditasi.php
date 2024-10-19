<?php

use App\Http\Controllers\PeringkatAkreditasiController;
use Illuminate\Support\Facades\Route;

$main_url = 'peringkat-akreditasi';

Route::get('/'.$main_url.'/peringkatakreditasibyidjson/{id}', [PeringkatAkreditasiController::class, 'peringkatakreditasibyidjson'])->name($main_url.'.getById');
Route::get('/'.$main_url.'/peringkatakreditasijson', [PeringkatAkreditasiController::class, 'peringkatakreditasijson']);
Route::resource($main_url, PeringkatAkreditasiController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

