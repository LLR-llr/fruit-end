<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        $model=model('Goods');
//        $result=$model->goodsquery();
        $data=$this->request->get();
        if(isset($data['page'])&&!empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=2;
        }
        $where=[];
        if(isset($data['cid'])&&!empty($data['cid'])){
            $where['cid']=$data['cid'];
        }
        if(isset($data['gname'])&&!empty($data['gname'])){
            $where['gname']=['like','%'.$data['gname'].'%'];
        }
        if(isset($data['min_price'])&&!empty($data['min_price'])&&isset($data['min_price'])&&!empty($data['min_price'])&&($data['min_price']<$data['max_price'])){
            $where['sale']=['between',[$data['min_price'],$data['max_price']]];
        }
        $result=Db::table('goods')->alias('g')->join('category','g.cid=category.id')->field('g.id,g.gname,g.thumb,g.description,g.gprice,g.sale,g.stock,g.volume,g.brand,g.norms,g.create_time,g.update_time,category.cname')->where($where)->paginate($limit,false,['page'=>$page]);
        $goods=$result->items();
        $count=$result->total();
        if($count>0&&$goods){
        return json([
            'code'=>config('code.success'),
            'msg'=>'查询成功',
            'data'=>$goods,
            'count'=>$count
        ]);
    }else{

        return json([
            'code'=>config('code.fail'),
            'msg'=>'查询失败',
            'data'=>$goods,
            'count'=>$count
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
        $data=$this->request->post();
        $model=model('Goods');
        $result=$model->add($data);
        if($result>0){
            return json([
                'code'=>config('code.success'),
                'msg'=>'插入成功'
            ]);
        }else{

            return json([
                'code'=>config('code.fail'),
                'msg'=>'插入失败'
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $model=model('Goods');
        $result=$model->editquery($id);
        if($result){
            return json([
                'code'=>config('code.success'),
                'msg'=>'查询成功',
                'data'=>$result
            ]);
        }else{

            return json([
                'code'=>config('code.fail'),
                'msg'=>'查询失败'
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
        $data=$this->request->put();

        $model=model('Goods');
        $result=$model->editupdate($data,$id);
        if($result>0){
            return json([
                'code'=>config('code.success'),
                'msg'=>'编辑成功'
            ]);
        }else{

            return json([
                'code'=>config('code.fail'),
                'msg'=>'编辑失败'
            ]);
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $model=model('Goods');
        $result=$model->del($id);
        if($result>0){
            return json([
                'code'=>config('code.success'),
                'msg'=>'删除成功'
            ]);
        }else{

            return json([
                'code'=>config('code.fail'),
                'msg'=>'删除失败'
            ]);
        }
    }
}
