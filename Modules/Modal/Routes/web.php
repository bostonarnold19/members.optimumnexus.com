<?php

Route::group(['middleware' => 'web', 'prefix' => 'sw2', 'namespace' => 'Modules\Modal\Http\Controllers'], function () {
    Route::group(['middleware' => 'subscription.modal'], function () {
        Route::get('/', [
            'uses' => 'UserClientController@index',
            'as' => 'get.clients.index',
        ]);
    });
    Route::group(['middleware' => 'subscription.modal'], function () {
        Route::get('/settings', [
            'uses' => 'UserClientController@settings',
            'as' => 'get.clients.settings',
        ]);
    });
});

Route::group(['middleware' => 'api', 'prefix' => 'api/sw2', 'namespace' => 'Modules\Modal\Http\Controllers'], function () {
    Route::post('/register', [
        'uses' => 'UserClientApiController@registerClient',
        'as' => 'post.register.client',
    ]);
});
