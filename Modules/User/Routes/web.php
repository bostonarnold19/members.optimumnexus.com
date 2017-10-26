<?php

Route::group(['middleware' => 'web', 'prefix' => 'registration', 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::get('/send-mail', [
        'uses' => 'UserRegistrationController@sendMailRegistrationForm',
        'as' => 'post.user.send-registration',
    ]);

});
