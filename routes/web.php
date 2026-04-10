<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;

Route::get('/', [CertificateController::class, 'index'])->name('home');
Route::post('/generate', [CertificateController::class, 'generate'])->name('generate');
Route::get('/verify/{id}', [CertificateController::class, 'verify'])->name('verify');



Route::get('/', function () {
    return view('welcome');
});