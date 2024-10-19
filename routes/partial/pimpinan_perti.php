<?php

use App\Http\Controllers\PimpinanOrganisasiController;
use Illuminate\Support\Facades\Route;

$main_url = 'pimpinan-perti';

Route::get('/'.$main_url.'/pimpinanpertibyidpertijson/{id_perti}', [PimpinanOrganisasiController::class, 'pimpinanpertibyidpertijson'])->name($main_url.'.getByIdPerti');
Route::get('/'.$main_url.'/pimpinanpertibyidjson/{id}', [PimpinanOrganisasiController::class, 'pimpinanpertibyidjson'])->name($main_url.'.getById');
Route::resource($main_url, PimpinanOrganisasiController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url.".store",
]);