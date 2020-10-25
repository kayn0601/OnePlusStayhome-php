<?php


namespace app\common\model;


use think\Model;

class Stayhome extends Model
{
    public function edit($data,$sid){
        return $this->allowField(true)->isUpdate(true)->save($data,['sid'=>$sid]);
    }

    public function queryOne($where,$field){
        return $this->field($field)->where($where)->find();
    }

    public function queryValue($where,$field){
        return $this->where($where)->value($field);
    }
}