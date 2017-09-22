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
    /* 分类页面  */
    Route::get('/category/{id}', 'CategoryController@index')->where(['id' => '[0-9]+']);
    /* 详情 页面  */
    Route::get('/detail/{id}', 'CategoryController@detail')->where(['id' => '[0-9]+']);
    /* 用户中心 */
    Route::prefix('user')->group(function () {
        Route::get('like','UserController@like')->middleware('checklogin');
        Route::get('/{id}', 'UserController@index')->where(['id' => '[0-9]+']);
        Route::get('/{id}/like', 'UserController@like')->name('user.like')->where(['id' => '[0-9]+']);
        Route::get('/{id}/attend', 'UserController@attend')->name('user.attend')->where(['id' => '[0-9]+']);
        Route::get('/{id}/comment', 'UserController@comment')->name('user.comment')->where(['id' => '[0-9]+']);
        Route::get('/{id}/share', 'UserController@share')->name('user.share')->where(['id' => '[0-9]+']);
        Route::get('/{id}/store', 'UserController@store')->name('user.stores')->where(['id' => '[0-9]+']);
        Route::get('/edit', 'UserController@edit')->middleware('checklogin');
        Route::get('/setPassword', 'UserController@setPassword')->middleware('checklogin');
        Route::get('/setAvatar', 'UserController@setAvatar')->middleware('checklogin');
        Route::get('/notice', 'UserController@notice')->middleware('checklogin');
        Route::get('/activation', 'UserController@activation')->middleware('checklogin');
        Route::post('/updateUserInfo', 'UserController@updateUserInfo')->middleware('checklogin');
    });
    /* 标签页面 */
    Route::get('/tag/{tagname}', 'TagsController@index')->where('tagname', '.*');
    Route::get('/getTagArticles', 'TagsController@getTagArticles');
    /* 文章    */
    Route::get('/getUserArticles', 'ArticleController@getUserArticles');
    Route::get('/getCategory', 'ArticleController@getCategory');
    Route::get('/getArticleComment', 'CommentController@getArticleComment');
    /* 用户中心 */
    Route::get('/write/{id?}', 'UserController@write')->middleware('checklogin');
    Route::post('/publish', 'UserController@publish')->middleware('checklogin');
    Route::get('/confirm/{type}/{code}', 'EmailController@confirm')->middleware('checklogin')->where(['type' => '[a-z]+', 'code' => '[0-9a-zA-Z]+']);
    /* 消息通知  */
    Route::post('/readNotice', 'NoticeController@readNotice')->middleware('checklogin');
    Route::post('/deleteNotice', 'NoticeController@deleteNotice')->middleware('checklogin');
    /* 用户关注  */
    Route::get('/getAttend', 'AttendController@getAttend')->middleware('checklogin');
    /* 用户评论 */
    Route::get('/getComments', 'CommentController@getComments')->middleware('checklogin');
    /* 用户收藏   */
    Route::get('/getStoreArticles', 'StoreController@getStoreArticles')->middleware('checklogin');
    /* 用户喜欢  */
    Route::get('/getLikeArticles', 'LikeController@getLikeArticles')->middleware('checklogin');
    /* 评论功能  */
    Route::post('/comment', 'CategoryController@comment')->middleware('checklogin');
    /* 上传头像  */
    Route::post('/uploadAvatar', 'FileController@uploadAvatar')->middleware('checklogin');
    Route::get('/email/send', 'EmailController@send')->middleware('checklogin');
    //邮件页面
    Route::get('/mail',function(){
        return new App\Mail\Notice();
    });
});

Route::domain('admin.blog.com')->middleware('auth')->namespace('Admin')->group(function(){    
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
Route::domain('admin.blog.com')->group(function(){
    Auth::routes();
});

