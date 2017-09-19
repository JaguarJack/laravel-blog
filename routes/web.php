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
Route::namespace('Home')->group(function(){
    Route::get('/', 'IndexController@index');
    Route::get('/signin', 'LoginController@signin');
    Route::get('/signup', 'RegisterController@signup');
    Route::post('/doRegister', 'RegisterController@doRegister');
    Route::post('/doLogin', 'LoginController@doLogin');
    Route::get('/signout', 'LoginController@signout');
   // Route::get('/{code}', 'CategoryController@index');
    Route::get('/detail/{id}', 'CategoryController@detail')->where(['id' => '[0-9]+']);
    
    Route::prefix('user')->middleware('checklogin')->group(function () {
        Route::get('like','UserController@like');
        Route::get('/{id}', 'UserController@index')->where(['id' => '[0-9]+']);
        Route::get('/like/{id}', 'UserController@like')->where(['id' => '[0-9]+']);;
        Route::get('/attend/{id}', 'UserController@attend')->where(['id' => '[0-9]+']);;
        Route::get('/comment/{id}', 'UserController@comment')->where(['id' => '[0-9]+']);;
        Route::get('/share/{id}', 'UserController@share')->where(['id' => '[0-9]+']);;
        Route::get('/store/{id}', 'UserController@store')->where(['id' => '[0-9]+']);;
        Route::get('/edit', 'UserController@edit');
        Route::get('/setPassword', 'UserController@setPassword');
        Route::get('/setAvatar', 'UserController@setAvatar');
        Route::get('/notice', 'UserController@notice');
        Route::get('/activation', 'UserController@activation');
        Route::post('/updateUserInfo', 'UserController@updateUserInfo');
    });
    Route::get('/tag/{tagname}', 'TagsController@index')->where('tagname', '.*');
    Route::get('/getUserArticles', 'ArticleController@getUserArticles');
    Route::get('/write', 'UserController@write')->middleware('checklogin');
    Route::post('/publish', 'UserController@publish')->middleware('checklogin');
    Route::post('/readNotice', 'NoticeController@readNotice')->middleware('checklogin');
    Route::post('/deleteNotice', 'NoticeController@deleteNotice')->middleware('checklogin');
   // Route::get('/user/{id}', 'UserController@index')->where(['id' => '[0-9]+']);
   // Route::get('/user/like', 'UserController@like');
   // Route::get('/user/attend', 'UserController@attend');
   // Route::get('/user/comment', 'UserController@comment');
   // Route::get('/user/share', 'UserController@share');
   // Route::get('/user/store', 'UserController@store');
   // Route::get('/user/edit', 'UserController@edit');
   // Route::get('/user/setPassword', 'UserController@setPassword');
   // Route::get('/user/setAvatar', 'UserController@setAvatar');
   // Route::get('/user/notice', 'UserController@notice');
   // Route::get('/user/activation', 'UserController@activation');
   // Route::get('/write', 'UserController@write');
    Route::post('/comment', 'CategoryController@comment')->middleware('checklogin');
});

Route::middleware('auth')->namespace('Admin')->group(function(){    
    Route::get('admin/index','IndexController@index');
    Route::get('/main','IndexController@main');
    Route::get('/user/index','UsersController@index');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleContrller');
    Route::resource('menu', 'MenuController');
    Route::resource('fmenu', 'FrontMenuController');
    Route::resource('seo', 'SeoController');
    Route::resource('links', 'LinksController');
});

Auth::routes();
