<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => ['web','auth'], 'namespace' => 'Modules\Scraper\Http\Controllers'], function () {

    Route::resource('scraper', 'ScraperController');

});

Route::group(['namespace' => 'Modules\Scraper\Http\Controllers'], function () {

    Route::get('user-workshop/{id}/{custom_url}', 'ScraperController@userWorkshop')->name('user.workshop');

});
