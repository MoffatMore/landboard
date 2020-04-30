<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::group(['prefix'=>'user', 'namespace'=>'Customer', 'as'=>'customer.'],function (){
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/plot/{id}/cancel-transfer', 'HomeController@cancelTransfer')->name('cancel-transfer');
        Route::get('/plots-advert', 'HomeController@plotsAdvert')->name('plots-advert');
        Route::get('/my-plots', 'HomeController@myPlots')->name('myPlots');
        Route::post('/submit-application','HomeController@submitApplication')->name('application-submit');
        Route::post('/transfer-plot','PlotController@transfer')->name('transfer-plot');
        Route::resource('application','Application');
    });

    Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'as'=>'admin.'], function (){
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/waiting-list', 'HomeController@waitingList')->name('waiting-list');
        Route::get('/appointments', 'HomeController@appointments')->name('appointments');
        Route::get('/ownership-transfer', 'HomeController@ownershipTransfer')->name('ownership-transfer');
        Route::get('/statistics', 'HomeController@statistics')->name('statistics');
        Route::get('/reject-application/{id}', 'HomeController@rejectApplication')->name('reject-application');
        Route::post('/accept-application/', 'HomeController@acceptApplication')->name('accept-application');
        Route::resource('appointment', 'Appointment');


    });
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});
