<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mkhodroo\AgencyInfo\Controllers\AgencyController;
use Mkhodroo\AgencyInfo\Controllers\AgencyDocsController;
use Mkhodroo\AgencyInfo\Controllers\AgencyListController;
use Mkhodroo\AgencyInfo\Controllers\CreateAgencyController;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\UserRoles\Controllers\GetRoleController;
use Rap2hpoutre\FastExcel\FastExcel;

Route::name('agencyInfo.')->prefix('agency-info')->middleware(['web', 'auth', 'access'])->group(function () {
    
    Route::get('create-form', [CreateAgencyController::class, 'view'])->name('createForm');
    Route::post('create', [CreateAgencyController::class, 'create'])->name('create');
    Route::get('list-form', [AgencyListController::class, 'view'])->name('listForm');
    Route::get('list', [AgencyListController::class, 'list'])->name('list');
    Route::post('filter-list', [AgencyListController::class, 'filterList'])->name('filterList');
    Route::get('edit/{parent_id}', [AgencyController::class, 'view'])->name('editForm');
    Route::post('edit', [AgencyController::class, 'edit'])->name('edit');
    Route::post('fin-edit', [AgencyController::class, 'finEdit'])->name('finEdit');
    Route::post('docs-edit', [AgencyDocsController::class, 'docsEdit'])->name('docsEdit');
    Route::post('delete-info', [AgencyController::class, 'deleteByKey'])->name('deleteByKey');
});
