<?php

Route::get('/', function () {
    return view('integration::home');
})->name('home');

Route::get('/live/errors', 'LogDashboardController@liveErrors')->name('live.errors');

Route::prefix('log')->group(function () {
    Route::get('/', 'LogDashboardController@index')->name('log.index');

    Route::get('/{id}/{tid}', 'LogDashboardController@show')
        ->name('log.show')
        ->where(['id' => '[0-9]+', 'tid' => '[0-9]+']);
});
