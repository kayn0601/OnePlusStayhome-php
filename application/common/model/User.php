<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp=true;

    public function add($data){
        return $this->allowField(true)->save($data);
    }

    public function queryOne($where,$field='uid,nickname,phone,collection'){
        return $this->field($field)->where($where)->find();
    }

    public function checkCol($sid,$uid){
        return $this->where('collection','like','%'.$sid.'%')->where('uid',$uid)->select();
    }

    public function updateCol($col,$uid){
        return $this->where('uid',$uid)->update(['collection'=>$col]);
    }
}