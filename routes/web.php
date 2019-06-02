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

/*0515削除
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
*/

Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cards', 'CardsController', ['only' => ['store', 'update', 'destroy', 'create', 'edit']]);
    
    Route::group(['prefix' => 'cards/{id}'], function (){
        Route::post('good', 'GoodController@good')->name('user.good');
        Route::post('bad', 'GoodController@bad')->name('user.bad');
        Route::delete('cancel_good', 'GoodController@destroy')->name('user.cancel_good');
    });
    
    Route::group(['prefix' => 'users/{id}'], function (){
        Route::get('like_cards', 'UsersController@good_cards')->name('users.good_cards');
        Route::get('account', 'UsersController@account')->name('users.account');
        
        Route::get('edit_name', 'UsersController@edit_name')->name('users.edit_name');
        Route::put('update_name', 'UsersController@update_name')->name('users.update_name');
        
        Route::get('edit_email', 'UsersController@edit_email')->name('users.edit_email');
        Route::put('update_email', 'UsersController@update_email')->name('users.update_email');
        
        Route::post('search_like_cards', 'SearchController@good_cards')->name('search.good_cards');
        Route::post('search_my_cards', 'SearchController@my_cards')->name('search.my_cards');
        Route::get('delete_account', 'UsersController@delete_account')->name('delete_account');
        Route::delete('', 'UsersController@destroy')->name('users.destroy');
    });
});

Route::get('search', 'SearchController@index')->name('search.index');

//0515追加
Auth::routes();

Route::get('auth/password/reset', 'Auth\AuthForgotPasswordController@showLinkRequestForm')->name('auth_password.request');
Route::post('auth/password/email', 'Auth\AuthForgotPasswordController@sendResetLinkEmail')->name('auth_password.email');
Route::post('auth/password/reset', 'Auth\AuthResetPasswordController@reset')->name('auth_password.reset');
Route::get('auth/password/reset/{token}', 'Auth\AuthResetPasswordController@showResetForm');

//Route::get('/home', 'HomeController@index')->name('home');
