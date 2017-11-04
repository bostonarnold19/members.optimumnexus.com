<?php

Route::group(['middleware' => 'api', 'prefix' => 'registration', 'namespace' => 'Modules\User\Http\Controllers'], function () {
    Route::get('/send-mail', [
        'uses' => 'UserController@sendMailRegistrationForm',
        'as' => 'post.user.send-registration',
    ]);
});

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function () {
    Route::get('/products', [
        'uses' => 'UserController@productList',
        'as' => 'get.user.product-list',
    ]);
});
