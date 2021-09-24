<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@root')->name('root');

// 用户模块
Auth::routes(['verify' => true]);


// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {

    // 收货地址
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');

    // 添加收货地址
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');

    // 收货地址数据入库
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');

});
