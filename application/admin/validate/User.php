<?php


namespace app\admin\validate;


use think\Validate;

class User extends Validate
{
    protected $rule=[
        'oldpass'=>'require',
        'pass'=>'require|confirm:checkPass',
        'checkPass'=>'require',
    ];
    protected $message=[
        'oldpass.require'=>'oldpass必传'  ,
        'pass.require'=>'pass必传'  ,
        'pass.confirm'=>'pass和checkPass必须一致'  ,
        'checkPass.require'=>'checkPass必传'
    ];
}