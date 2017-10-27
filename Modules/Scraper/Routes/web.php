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

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Scraper\Http\Controllers'], function () {

    Route::resource('scraper', 'ScraperController');

});

Route::get('user-workshop/{id}/{custom_url}', 'WorkshopController@userWorkshop')->name('user.workshop');