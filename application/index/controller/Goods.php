<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        $id=$data['id'];
        $result=Db::table('goods')->where('id',$id)->select();
        if($result>0){
            return json([
                'code'=>config('code.success'),
                'msg'=>'获取商品信息成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code'=>config('code.fail'),
                'msg'=>'获取商品信息失败',
                'data'=>$result
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
        $data=$this->request->get();
        if(isset($data['page2'])&&!empty($data['page2'])){
            $page=$data['page2'];
        }else{
            $page=1;
        }
        if(isset($data['limit2'])&&!empty($data['limit2'])){
            $limit=$data['limit2'];
        }else{
            $limit=1;
        }
        $goods=Db::table('goods')->where('cid',$id)->paginate($limit,false,['page'=>$page]);
        $data=$goods->items();
        $total=$goods->total();
        if($total>0&&count($data)){
            return json([
                'code'=>config('code.success'),
                'msg'=>'获取分类成功',
                'data'=>$data,
                'total'=>$total
            ]);
        }else{
            return json([
                'code'=>config('code.fail'),
                'msg'=>'获取分类失败'
            ]);
        }
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
