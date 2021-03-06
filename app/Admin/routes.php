<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    // 用户
    $router->get('users', 'UsersController@index');
    // 商品管理
    $router->get('products', 'ProductsController@index');
    // 创建商品
    $router->get('products/create', 'ProductsController@create');
    // 接收商品
    $router->post('products', 'ProductsController@store');
    // 编辑界面
    $router->get('products/{id}/edit', 'ProductsController@edit');
    // 接收编辑数据
    $router->put('products/{id}', 'ProductsController@update');
    // 订单列表
    $router->get('orders', 'OrdersController@index')->name('orders.index');
    // 订单详情
    $router->get('orders/{order}', 'OrdersController@show')->name('orders.show');
    // 发货
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('orders.ship');

    // 退款
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('orders.handle_refund');

    // 优惠券
    $router->get('coupon_codes', 'CouponCodesController@index');
    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');

});
