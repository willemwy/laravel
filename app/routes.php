<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before' => "auth"), function() {
    Route::get('/adduser/{albumId}', "HomeController@addUserPage");
    Route::get('/create-lounge', "HomeController@homePage");
    Route::post('/create-lounge', "HomeController@homePagePost");
    Route::post('/create-image/{albumId}', "HomeController@createImagePost");
    Route::get('/wingle', "HomeController@winglePage");
    Route::get('/album/{albumId}', "HomeController@albumPage");
    Route::post('/album/{albumId}', "HomeController@albumPostPage");
    Route::get('/image/{imageId}', "HomeController@imagePage");
    Route::any('/rate/{imageId}', "HomeController@rateImagePage");
    Route::get('/users', "HomeController@usersPage");
    Route::get('/profile', "HomeController@profilePage");
    Route::Post('/profile', "HomeController@profilePagePost");
    Route::get('/logout', "HomeController@logoutPage");
    Route::get('/remove_user', "HomeController@removeUser");
    Route::get('/remove_album/{albumId}', "HomeController@removeAlbum");
});
Route::get('/social/{action?}', "HomeController@loginPage");
Route::get('/', "LandingController@landingPage");
Route::get('/privacy', "LandingController@termsPage");
Route::get('/conditions', "LandingController@conditionsPage");

