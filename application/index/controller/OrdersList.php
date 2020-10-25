<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class OrdersList extends Controller
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
        $get = $this->request->get();
        $type = $get['type'];
        checkUserToken();
        $uid = $this->request->uid;
        $stayhomeModel = model('Stayhome');

        if ($type==0 || !isset($type)){
            $orders = $this->model->queryAll(['uid'=>$uid],'oid,sid,enter_time,leave_time,status,price');
        }else{
            $orders = $this->model->queryAll(['uid'=>$uid,'status'=>$type],'oid,sid,enter_time,leave_time,status,price');
        }

        for ($i=0;$i<count($orders);$i++){
            $orders[$i]['sthumb'] = $stayhomeModel->queryValue(['sid'=>$orders[$i]['sid']],'sthumb');
            $orders[$i]['sname'] = $stayhomeModel->queryValue(['sid'=>$orders[$i]['sid']],'sname');
        }

        if ($orders){
            return json([
                'code'=>$this->code['success'],
                'msg'=>'订单数据获取成功',
                'data'=>$orders
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'订单数据获取失败',
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
        //
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
        //
    }
}
