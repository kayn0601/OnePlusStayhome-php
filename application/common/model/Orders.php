<?php


namespace app\common\model;


use think\Model;

class Orders extends Model
{
    protected $autoWriteTimestamp = true;
    protected $table = 'orders';

    public function add($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }

    public function queryAll($where,$field){
        return $this->field($field)->where($where)->select();
    }

    public function queryPaginate($page,$limit,$field="*",$where=[]){
        return $this->field($field)->where($where)->order('create_time', 'desc')->paginate($limit,false,['page'=>$page]);
    }

    public function queryValue($where,$field){
        return $this->where($where)->value($field);
    }

    public function edit($data,$oid){
        return $this->allowField(true)->isUpdate(true)->save($data,['oid'=>$oid]);
    }

    public function quit($where){
        return $this->where($where)->delete();
    }
}