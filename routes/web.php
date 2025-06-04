<?php

use App\Http\Controllers\VatProcessingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    redirect(route('vat.processing.index'));
})->name('home');

Route::resource('vat-processing', VatProcessingController::class)
    ->except(['destroy', 'edit', 'update'])
    ->names('vat.processing');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
