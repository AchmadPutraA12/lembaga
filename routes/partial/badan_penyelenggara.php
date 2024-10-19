<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

$main_url = 'badan-penyelenggara';

Route::get('/organizationbyidorganizationtype/{id_organization_type}', [OrganizationController::class, 'organizationbyidorganizationtype']);
Route::get('/organizationbydefinedid/{org_defined_id}', [OrganizationController::class, 'organizationbydefinedid']);
Route::get('/'.$main_url.'/badanpenyelenggarabyidjson/{org_defined_id}', [OrganizationController::class, 'badanpenyelenggarabyidjson'])->name($main_url.'.getBPById');
Route::get('/'.$main_url.'/badanpenyelenggarajson', [OrganizationController::class, 'badanpenyelenggarajson'])->name($main_url.'.bpjson');
Route::get('/'.$main_url.'/badanpenyelenggarabyidptjson/{id_pt}', [OrganizationController::class, 'badanpenyelenggarabyidptjson'])->name($main_url.'.getBPByidPT');
Route::get('/'.$main_url.'/badanpenyelenggaradefault', [OrganizationController::class, 'badanpenyelenggaradefault'])->name($main_url.'.default');
Route::resource($main_url, OrganizationController::class)->names([
    'index' => $main_url,
    'store' =>  $main_url."store",
]);

