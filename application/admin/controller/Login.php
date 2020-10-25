<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;

/*
 * 1.验证权限
 * 2.验证请求方式
 * 3.接收前台发送数据
 * 4.前台数据验证 admin/validate/Login.php
 * 5.业务逻辑
 * */
class Login extends Controller
{
    public function check(){
        $method=$this->request->method();
        if ($method!='POST'){
            return json([
                'code'=>404,
                'msg'=>'请求方式错误'
            ]);
        }
        $data=$this->request->post();
        $validate=validate('Login');
        $flag=$validate->check($data);
        if (!$flag){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $whereArr=['username'=>$data['username']];
        $user=Db::table('admin')->where($whereArr)->find();
        if ($user){
            $password=md5(crypt($data['password'],config('salt')));
            if ($password===$user['password']){
                $payload=[
                  'id'=>$user['id'],
                  'username'=>$user['username'],
                  'avatar'=>$user['avatar']
                ];
                $token=JWT::getToken($payload,config('jwtkey'));
                return json([
                    'code'=>200,
                    'msg'=>'登录成功',
                    'token'=>$token,
                    'user'=>$payload
                ]);
            }else{
                return json([
                    'code'=>404,
                    'msg'=>'用户名和密码不匹配'
                ]);
            }
        }else{
            return json([
                'code'=>404,
                'msg'=>'用户不存在'
            ]);
        }
    }
}