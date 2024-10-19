<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'handle'])->name('handle');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/authenticate', [AuthController::class, "authenticate"])->name('authenticate');
Route::get('/unauthenticate', [AuthController::class, "unauthenticate"])->name('unauthenticate');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    require __DIR__.'/partial/peringkat_akreditasi.php';
    require __DIR__.'/partial/lembaga_akreditasi.php';
    require __DIR__.'/partial/jabatan_pimpinan.php';
    require __DIR__.'/partial/badan_penyelenggara.php';
    require __DIR__.'/partial/perguruan_tinggi.php';
    require __DIR__.'/partial/program_studi.php';
    require __DIR__.'/partial/pimpinan_perti.php';

    require __DIR__.'/partial/user.php';
    require __DIR__.'/partial/role.php';
    require __DIR__.'/partial/profile.php';
});
