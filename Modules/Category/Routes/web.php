<?php

Route::group(['middleware' => ['web', 'auth', 'role:Admin'], 'namespace' => 'Modules\Category\Http\Controllers'], function () {

    // Route::resource('category', 'CategoryController');

});
