<?php

function test_helper() {
    return 'OK';
}

// 路由
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
