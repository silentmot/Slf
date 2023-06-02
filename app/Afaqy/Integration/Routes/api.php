<?php

Route::prefix('v1/zk')->middleware([])->group(function () {
    Route::post('/token', 'AuthController@token');

    Route::middleware(['client:zk'])->group(function () {
        Route::post('/car_information', 'ZkController@carInformation');
        Route::post('/device_status', 'ZkController@deviceStatus');
    });
});
