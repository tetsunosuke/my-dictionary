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

Route::get('/', 'CardsController@index')->name('home');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cards', 'CardsController', ['only' => ['store', 'update', 'destroy', 'create', 'edit']]);
    
    Route::group(['prefix' => 'cards/{id}'], function (){
        Route::post('good', 'GoodController@good')->name('user.good');
        Route::post('bad', 'GoodController@bad')->name('user.bad');
        Route::delete('cancel_good', 'GoodController@destroy')->name('user.cancel_good');
    });
    
    Route::group(['prefix' => 'users/{id}'], function (){
        Route::get('good_cards', 'UsersController@good_cards')->name('users.good_cards');
        Route::post('search_good_cards', 'SearchController@good_cards')->name('search.good_cards');
        Route::post('search_my_cards', 'SearchController@my_cards')->name('search.my_cards');
    });
});

Route::get('search', 'SearchController@index')->name('search.index');