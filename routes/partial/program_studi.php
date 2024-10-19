<?php

use App\Http\Controllers\ProgramStudiController;
use Illuminate\Support\Facades\Route;

$main_url = 'program-studi';

Route::get('/'.$main_url.'/prodibyidpertijson/{id_perti}', [ProgramStudiController::class, 'prodibyidpertijson'])->name($main_url.'.getByIdperti');
Route::get('/'.$main_url.'/programstudibyjson', [ProgramStudiController::class, 'programstudijson']);
Route::resource($main_url, ProgramStudiController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url.".store",
]);

