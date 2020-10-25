<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;
Route::resource('api/stayhome','admin/Stayhome');
Route::resource('admin/orders','admin/Orders');
Route::resource('index/index','index/Index');
Route::resource('index/detail','index/Detail');
Route::resource('index/lists','index/Lists');
Route::resource('index/user','index/User');
Route::resource('index/login','index/Login');
Route::resource('index/collection','index/Collection');
Route::resource('index/collectionlist','index/CollectionList');
Route::resource('index/orders','index/Orders');
Route::resource('index/orderslist','index/OrdersList');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
