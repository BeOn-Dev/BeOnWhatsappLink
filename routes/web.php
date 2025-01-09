<?php

use Illuminate\Support\Facades\Route;


Route::get('/',[\App\Http\Controllers\WhatsappLinkController::class,'login']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('webhook/beon', [\App\Http\Controllers\WhatsappLinkController::class,'callback']);

Route::get('/check-auth-status', [\App\Http\Controllers\WhatsappLinkController::class, 'checkStatus'])->name('check-auth-status');
