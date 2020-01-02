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

/**
 * 微信开发
 */
Route::prefix('wechat')->group(function () {
    Route::any('/link','WechatController@wechat');
});




//后台路由
Route::prefix('admin')->group(function () {
    Route::get('/login','Admin\LoginController@login');
    Route::any('/login_do','Admin\LoginController@login_do');
});
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::get('/index','Admin\LoginController@index');
    Route::get('/index_v1','Admin\LoginController@index_v1');

});