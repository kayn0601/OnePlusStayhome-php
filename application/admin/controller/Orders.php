<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Orders extends Controller
{
    public $code;
    public $model;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
        $this->model=model('Orders');
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->request->get();
        if(isset($data['page']) && !empty($data['page'])){
            $page = $data['page'];
        }else{
            $page = 1;
        }
        if(isset($data['limit']) && !empty($data['limit'])){
            $limit = $data['limit'];
        }else{
            $limit = 5;
        }

        $result = $this->model->queryPaginate($page,$limit,"oid,uid,sid,enter_time,leave_time,status,price,user_info,phone");
        $items = $result->items();
        $total = $result->total();
        if ($result){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'订单数据获取成功',
                'data'=>$items,
                'count'=>$total
            ]);
        }else{
            return json([
                'code'=>$this->code['success'],
                'msg'=>'暂无订单'
            ]);
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $result=Db::table('orders')->where('oid',$id)->update(['status'=>3]);
        if ($result){
            return json([
               'code'=>$this->code['success'],
               'msg'=>'订单完成成功'
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'订单完成失败'
            ]);
        }
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = $this->model->quit(['oid'=>$id]);
        if ($result){
            return json([
               'code'=>$this->code['success'],
               'msg'=>'订单删除成功'
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'订单删除失败'
            ]);
        }
    }
}
