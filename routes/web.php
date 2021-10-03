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


Route::get('alipay', function() {

    return app('alipay')->web([
        'out_trade_no' => time(),
        'total_amount' => '1',
        'subject' => 'test subject - 测试',
    ]);
});

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

    // 购物车列表
    Route::get('cart', 'CartController@index')->name('cart.index');
    // 移除购物车商品
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');
    // 下单
    Route::post('orders', 'OrdersController@store')->name('orders.store');
    // 用户订单列表
    Route::get('orders', 'OrdersController@index')->name('orders.index');
    // 订单详情页
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
    // 支付订单
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    // 支付宝回调
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
    // 发起微信支付
    Route::get('payment/{order}/wechat', 'PaymentController@payByWechat')->name('payment.wechat');

    // 确认收货
    Route::post('orders/{order}/received', 'OrdersController@received')->name('orders.received');
    // 评价页
    Route::get('orders/{order}/review', 'OrdersController@review')->name('orders.review.show');
    // 接受评价参数
    Route::post('orders/{order}/review', 'OrdersController@sendReview')->name('orders.review.store');
});

// 支付宝回调
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');
// 微信回调
Route::post('payment/wechat/notify', 'PaymentController@wechatNotify')->name('payment.wechat.notify');

// 首页
Route::redirect('/', '/products')->name('root');

// 商品列表
Route::get('products', 'ProductsController@index')->name('products.index');
// 商品详情页
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

