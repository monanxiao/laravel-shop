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

// Route::get('/', 'PagesController@root')->name('root');


// 用户模块
Auth::routes();
Auth::routes(['verify' => true]);

 // 收藏列表
Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');


// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {

    // 收货地址
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');

    // 添加收货地址
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');

    // 收货地址数据入库
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');

    // 修改收货地址
    Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');

    // 接受收货地址更新数据
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');

    // 删除收货地址
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    // 接收 收藏商品
    Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
    // 取消收藏
    Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');

    // 接收购物车参数
    Route::post('cart', 'CartController@add')->name('cart.add');
});

// 首页
Route::redirect('/', '/products')->name('root');

// 商品列表
Route::get('products', 'ProductsController@index')->name('products.index');
// 商品详情页
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

