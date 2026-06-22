<?php

use App\Http\Controllers\PatientReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('patients/{patient}/reports/durum-bildirir', [PatientReportController::class, 'durumBildirir'])
        ->name('patients.reports.durum-bildirir');
});
