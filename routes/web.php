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
// Route::get('/my-activity','ActivityController@index');
Route::get('/get-activity/{id}','ActivityController@getActivity');
Route::get('/get-favourite-genres/{id}','ActivityController@getFavouriteGenres');

//MOVIE
Route::get('/movie/{id}','MovieController@index');
Route::post('/checkInMovie','WatchController@checkInMovie'); //untuk check in film
Route::post('/ratingMovie','RatingController@ratingMovie');

//REVIEW
Route::get('/movie/{id}/review','ReviewController@showReview');
Route::post('/reviewMovie','ReviewController@reviewMovie');
Route::post('/editReviewMovie','ReviewController@editReview');
Route::post('/deleteReviewMovie','ReviewController@deleteReview');

//PROFILE
Route::get('/profile/{id}','ProfileController@index');
Route::get('/profile/{id}/timeline','ProfileController@timeline');
Route::get('/profile/{id}/following','ProfileController@following');
Route::get('/profile/{id}/followers','ProfileController@followers');
Route::get('/profile/{id}/reviews','ProfileController@reviews');
Route::get('/profile/{id}/discussion','ProfileController@discussion');

Route::get('/changepassword','ProfileController@viewChangePasswordForm');
Route::post('/changepassword','ProfileController@changePassword');

Route::post('/profile/{id}/follow','ProfileController@follow');
Route::post('/profile/edit', 'ProfileController@editProfile');

//FEED
Route::get('/feed','FeedController@index');

//FORUM
Route::get('/movie/{id}/forum','ThreadController@index');
Route::post('/createThread','ThreadController@createThread');
Route::get('/thread/{id}','ThreadController@showThreadDetail');
Route::post('/createPost','ThreadController@createPost');


//ADMIN
Route::get('/banUser/{id}','AdminController@banUser');
Route::get('/deleteThread/{id}','AdminController@deleteThread');
Route::get('/deletePost/{id}','AdminController@deletePost');
Route::get('/deleteReview/{id}','AdminController@deleteReview');
