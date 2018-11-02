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

// LOGIN
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@Login')->name('login');
Route::get('/logout','LoginController@Logout');

//REGISTER
Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@Register');

//HOME
Route::get('/home','HomeController@home');
Route::get('/search','HomeController@search');
Route::get('/discover','HomeController@discover');

//ACTIVITY
Route::get('/my-activity','ActivityController@index');
Route::get('/get-activity','ActivityController@getActivity');
Route::get('/get-favourite-genres','ActivityController@getFavouriteGenres');

//MOVIE
Route::get('/movie/{id}','MovieController@index');
Route::post('/checkInMovie','MovieController@checkInMovie'); //untuk check in film
Route::post('/ratingMovie','MovieController@ratingMovie');

//REVIEW
Route::get('/movie/{id}/review','MovieController@showReview');
Route::post('/reviewMovie','MovieController@reviewMovie');
Route::post('/editReviewMovie','MovieController@editReview');
Route::post('/deleteReviewMovie','MovieController@deleteReview');

//PROFILE
Route::get('/profile/{id}','ProfileController@index');
Route::post('/profile/{id}/follow','ProfileController@follow');


//FEED
Route::get('/feed','FeedController@index');

//FORUM
Route::get('/movie/{id}/forum','MovieController@showForum');
Route::post('/createThread','MovieController@createThread');
//Route::get('/movie/{id}/forum/{tid}','MovieController@showThreadDetail');
Route::get('/thread/{id}','MovieController@showThreadDetail');
Route::post('/createPost','MovieController@createPost');
