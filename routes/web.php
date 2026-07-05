<?php

use App\Http\Controllers\AccessKeyController;
use Illuminate\Support\Facades\Route;

Route::prefix(env('APP_SECRET'))->name('app.')->group(function(){
    Route::get('/',fn() => to_route('app.access-key.index'));

    Route::prefix('access-key')->controller(AccessKeyController::class)->name('access-key.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/create','store')->name('store');
        Route::delete('/delete/{access_key}','destroy')->name('delete');
    });
});

Route::get('/access/{access_key:public_id}',[AccessKeyController::class,'show'])->name('show');