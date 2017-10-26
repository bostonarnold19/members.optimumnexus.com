<?php

Route::group(['middleware' => 'web', 'prefix' => 'client', 'namespace' => 'Modules\Modal\Http\Controllers'], function () {

    Route::get('/', [
        'uses' => 'UserClientController@index',
        'as' => 'get.clients.index',
    ]);

});

Route::group(['middleware' => 'api', 'prefix' => 'api/client', 'namespace' => 'Modules\Modal\Http\Controllers'], function () {

    Route::post('/register', [
        'uses' => 'UserClientApiController@registerClient',
        'as' => 'post.register.client',
    ]);

});
