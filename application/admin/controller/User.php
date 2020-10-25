<?php


namespace app\admin\controller;

use think\Controller;
use think\Db;

class User extends Controller
{
    public function editPassword(){
        checkToken();
        $data = $this->request->post();
        $validate = validate('User');
        if (!$validate->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $id = $this->request->id;
        $oldPass=Db::table("admin")->where('id',$id)->value('password');
        if (secretPassword($data['oldpass'])!==$oldPass){
            return json([
                'code'=>404,
                'msg'=>'原密码错误'
            ]);
        }else{
            $result=Db::table('admin')->where('id',$id)->update(['password'=>secretPassword($data['pass'])]);
            if ($result){
                return json([
                    'code'=>200,
                    'msg'=>'密码修改成功'
                ]);
            }else{
                return json([
                    'code'=>404,
                    'msg'=>'密码修改失败'
                ]);
            }
        }
    }
}