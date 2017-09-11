<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::get('/', [
        'uses' => 'UserController@index',
        'as' => 'get.user.index',
    ]);

});
