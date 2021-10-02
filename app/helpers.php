<?php

function test_helper() {
    return 'OK';
}

// 路由
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

// 内网代理
function ngrok_url($routeName, $parameters = [])
{
    // 开发环境，并且配置了 NGROK_URL
    if(app()->environment('local') && $url = config('app.ngrok_url')) {
        // route() 函数第三个参数代表是否绝对路径
        return $url.route($routeName, $parameters, false);
    }

    return route($routeName, $parameters);
}
