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
    Route::any('/login','Admin\LoginController@login');
    Route::any('/login_do','Admin\LoginController@login_do');

    Route::any('/index','Admin\IndexController@index');
    Route::any('/add','Media\MediaController@add');
    Route::any('/show','Media\MediaController@show');
    Route::any('/add_do','Media\MediaController@add_do');
    Route::any('/report_add','Media\ReportController@add');
    Route::any('/report_add_do','Media\ReportController@add_do');
    Route::any('/report_show','Media\ReportController@show');
});
Route::prefix('admin')->middleware('checkLogin')->group(function () {

});