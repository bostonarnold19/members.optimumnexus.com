<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::get('/', [
        'uses' => 'UserController@index',
        'as' => 'get.user.index',
    ]);

});

Route::group(['middleware' => 'api', 'prefix' => 'api/client', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::post('/register', [
        'uses' => 'ClientRegistrationController@registerClient',
        'as' => 'post.register.client',
    ]);

});

Route::group(['middleware' => 'web', 'prefix' => 'registration', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::get('/send-mail', [
        'uses' => 'UserRegistrationController@sendMailRegistrationForm',
        'as' => 'post.user.send-registration',
    ]);

});
