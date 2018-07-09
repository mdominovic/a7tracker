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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['middleware' => 'auth'], function () {
//   Route::get('profile', [
//       'uses' => ''
//   ])
//});

Route::group(['middleware' => 'auth'], function () {
//    Route::post('device/store', [
//        'uses' => 'DeviceController@store',
//        'as' =>  'device.store'
//    ]);
//
//    Route::get('device/create', [
//        'uses' => 'DeviceController@create',
//        'as' => 'device.create'
//    ]);


    Route::resource('device', 'DeviceController');

//    Route::get('devices', [
//        'uses' => 'DeviceController@index',
//        'as' => 'device.index'
//    ]);

    Route::get('location/show', [
        'uses' => 'LocationController@show',
        'as' => 'location.show'
    ]);
});