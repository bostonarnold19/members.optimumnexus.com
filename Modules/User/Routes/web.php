<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::get('/', [
        'uses' => 'UserController@index',
        'as' => 'get.user.index',
    ]);

});

Route::group(['middleware' => 'api', 'prefix' => 'client', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::post('/register', [
        'uses' => 'ClientRegistrationController@registerClient',
        'as' => 'post.register.client',
    ]);

});
