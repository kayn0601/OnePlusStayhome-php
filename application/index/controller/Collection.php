<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Collection extends Controller
{
    public $code;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code = config('code');
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $model = model('User');
        $data=$this->request->get();
        $sid = $data['sid'];
        checkUserToken();
        $uid = $this->request->uid;

        $col = Db::table('user')->where('uid',$uid)->value('collection');
        $colArr = explode(',',$col);
        $check = $model->checkCol($sid,$uid);
        if ($check){
            $key = array_search($sid,$colArr);
            array_splice($colArr,$key,1);
            $col = implode(',',$colArr);
            $result = $model->updateCol($col,$uid);
            if ($result){
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>'取消收藏成功',
                ]);
            }else{
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>'取消收藏失败',
                ]);
            }
        }else{
            array_unshift($colArr,$sid);
            $col = implode(',',$colArr);
            $result = $model->updateCol($col,$uid);
            if ($result){
                return json([
                    'code'=>$this->code['success'],
                    'msg'=>'收藏成功',
                ]);
            }else{
                return json([
                    'code'=>$this->code['fail'],
                    'msg'=>'收藏失败',
                ]);
            }
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
