<?php

Route::group(['middleware' => 'api', 'prefix' => 'api/user', 'namespace' => 'Modules\User\Http\Controllers'], function () {
    Route::post('/registration/send-mail', [
        'uses' => 'UserApiController@sendMailRegistrationForm',
        'as' => 'post.user.send-registration',
    ]);
    Route::post('/user-check', [
        'uses' => 'UserApiController@userCheck',
        'as' => 'post.user.check',
    ]);
});

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function () {
    Route::get('/products', [
        'uses' => 'UserController@productList',
        'as' => 'get.user.product-list',
    ]);
});
