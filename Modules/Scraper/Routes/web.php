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

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Modules\Scraper\Http\Controllers'], function () {

    Route::group(['middleware' => 'subscription.scraper'], function () {

        Route::resource('scraper', 'ScraperController');
        Route::post('scraper-affiliate-number', 'ScraperController@saveAffiliateNumber')->name('scraper.affiliate');
        Route::get('create-event', 'ScraperController@createEvent')->name('scraper.create.event');
        Route::post('scrape-page', 'ScraperController@scrapeSelected')->name('scraper.scrape');
        Route::post('store-event', 'ScraperController@storeEvent')->name('scraper.store.event');
        Route::get('view-event', 'ScraperController@eventAttendees')->name('view.event');
        Route::get('get-event/{id}', 'ScraperController@getEvent')->name('scraper.get.event');
    });

});

Route::group(['namespace' => 'Modules\Scraper\Http\Controllers'], function () {

        Route::get('user-workshop/{id}/{custom_url}', 'ScraperController@userWorkshop')->name('user.workshop');

});

Route::group(['middleware' => 'api', 'prefix' => 'api/workshop', 'namespace' => 'Modules\Scraper\Http\Controllers'], function () {
    Route::post('/check-user', [
        'uses' => 'WorkshopApiController@checkUser',
        'as' => 'post.check.user',
    ]);
    Route::post('/add-attendee', [
        'uses' => 'WorkshopApiController@addEventAttendee',
        'as' => 'post.check.user',
    ]);
});
