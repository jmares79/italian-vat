<?php

use App\Http\Controllers\SingleVatNumberProcessingController;
use App\Http\Controllers\VatProcessingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('vat.processing.index'));
})->name('home');

// Routes to validate a single VAT number for ITALY for the moment
Route::view('/vat-processing/validate', 'validate');

Route::post('vat-processing/validate', [SingleVatNumberProcessingController::class, 'validate'])
    ->name('vat.processing.validate');

// route for validating and handling VAT via file upload
Route::resource('vat-processing', VatProcessingController::class)
    ->except(['destroy', 'edit', 'update', 'show'])
    ->names('vat.processing');
