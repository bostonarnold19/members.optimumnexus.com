<?php

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Modules\Funnel\Http\Controllers'], function () {

    Route::group(['middleware' => 'subscription.bagel'], function () {

        Route::resource('funnel', 'FunnelController');
        Route::post('funnel/attach_page/{id}', [
            'uses' => 'FunnelController@attachPage',
            'as' => 'funnel.attach_page',
        ]);;
        Route::resource('page', 'PageController');

        Route::get('bagel', 'FunnelController@index')->name('bagel');

        Route::resource('category-bagel', 'CategoryController');

    });

});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Modules\User\Http\Controllers'], function () {

    Route::group(['middleware' => 'subscription.bagel'], function () {

        Route::post('/update-wp-site/{id}', [
            'uses' => 'UserController@updateWpSite',
            'as' => 'post.user.update-wp-site',
        ]);

    });

});
