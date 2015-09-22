<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::filter('admin', function()
{
    if(Auth::check()) {
        if (!Auth::user()->admin) {
            Flash::error('You must be an admin to access this feature.');
            return Redirect::to('/');
        }
    } else {
        Flash::error('You must be an admin to access this feature.');
        return Redirect::to('/');
    }
});
Route::filter('loggedin', function()
{
    if(!Auth::check()) {
        Flash::error('You must be logged in to access this feature.');
        return Redirect::to('/');
    }
});



Route::when('/import/*', 'admin');


Route::get('/', 'PagesController@home');


Route::get('/download', array('before' => 'loggedin', 'uses' =>'DownloadController@index'));
Route::get('/download/{type}', array('before' => 'loggedin', 'uses' =>'DownloadController@handler'));

/* user routes */
Route::get('/users', array('before' => 'admin', 'uses' =>'UserController@show'));
Route::get('/users/toggleadmin/{userid}', array('before' => 'admin', 'uses' =>'UserController@toggleAdmin'));

/* handle blocks */
Route::get('/blocks/', 'BlocksController@index');
Route::get('/blocks/new/', array('before' => 'loggedin', 'uses' =>'BlocksController@create'));
Route::get('/blocks/edit/{id}', array('before' => 'loggedin', 'uses' =>'BlocksController@edit'));
Route::get('/blocks/delete/{id}', array('before' => 'loggedin', 'uses' =>'BlocksController@destroy'));
Route::post('/blocks/', array('before' => 'csrf', 'uses' =>'BlockController@store'));

/* ban page */
Route::get('/banned', 'PagesController@banned');

Route::resource('/import','ImportController');
Route::controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController'
]);


