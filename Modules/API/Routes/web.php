<?php

Route::group(['middleware' => 'api', 'prefix' => 'api', 'namespace' => 'Modules\API\Http\Controllers'], function () {
    Route::post('/login', [
        'uses' => 'APIController@login',
        'as' => 'api.login',
    ]);

    Route::post('sync-pages', [
        'uses' => 'APIController@syncPages',
        'as' => 'sync.pages',
    ]);
});
