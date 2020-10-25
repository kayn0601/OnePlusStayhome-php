<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\JWT;
// 应用公共文件

function checkToken(){
    $get_token = request()->get('token');
    $post_token = request()->post('token');
    $header_token = request()->header('token');
    if ($get_token){
        $token = $get_token;
    }else if($post_token){
        $token = $post_token;
    }else if($header_token){
        $token = $header_token;
    }else{
        json(['code'=>404,'msg'=>'token不能为空'],401)->send();
        exit();
    }
    $tokenResult = JWT::verify($token,config('jwtkey'));
    if (!$tokenResult){
        json(['code'=>404,'msg'=>'token验证失败'],401)->send();
        exit();
    }
    request()->id = $tokenResult['id'];
    request()->username = $tokenResult['username'];
}

function checkUserToken(){
    $get_token = request()->get('token');
    $post_token = request()->post('token');
    $header_token = request()->header('token');
    if ($get_token){
        $token = $get_token;
    }else if($post_token){
        $token = $post_token;
    }else if($header_token){
        $token = $header_token;
    }else{
        json(['code'=>404,'msg'=>'token不能为空'],401)->send();
        exit();
    }
    $tokenResult = JWT::verify($token,config('jwtkey'));
    if (!$tokenResult){
        json(['code'=>404,'msg'=>'token验证失败'],401)->send();
        exit();
    }
    request()->uid = $tokenResult['uid'];
    request()->nickname = $tokenResult['nickname'];
}


function secretPassword($pass){
    return md5(crypt($pass,config('salt')));
}
function resetpassword(){
    return md5(crypt(config('defaultPassword'),config('salt')));
}

function sexCodeToText($code){
    $text = '男';
    $sexArr = ['未填写','男','女'];
    if (isset($sexArr[$code])){
        $text = $sexArr[$code];
    }
    return $text;
}