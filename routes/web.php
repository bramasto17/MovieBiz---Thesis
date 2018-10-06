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
Route::get('/','HomeController@index');

Route::get('/login','LoginController@index');
Route::post('/login','LoginController@Login')->name('login');
Route::get('/logout','LoginController@Logout');

Route::get('/home','HomeController@home');
Route::get('/search','HomeController@search');

Route::get('/my-activity','ActivityController@index');
Route::get('/get-activity','ActivityController@getActivity');

// Route::get('/register','RegisterController@index');
// Route::post('/register','RegisterController@Register');

Route::get('/movie/{id}','MovieController@index');
Route::get('/movie/{id}/review','MovieController@showReview');
Route::post('/checkInMovie','MovieController@checkInMovie'); //untuk check in film
Route::post('/ratingMovie','MovieController@ratingMovie');
Route::post('/reviewMovie','MovieController@reviewMovie');
