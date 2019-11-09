<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        try {
            $cate = Db::table('category')->field('id,cname,thumb')->order('sort', 'asc')->limit(0,4)->select();
            $len = count($cate);
            if ($len) {
                for ($i = 0; $i < $len; $i++) {
                    $id = $cate[$i]['id'];
                    $goods = Db::table('goods')->field('id,gname,sale,gprice,thumb')->where('cid', $id)->limit(0, 3)->select();
                    $cate[$i]['goods'] = $goods;
                }
                return json([
                    'code' => config('code.success'),
                    'msg' => '数据获取成功',
                    'data' => $cate
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '数据获取失败'
                ]);
            }
        }catch(\Exception $exception){
            return json([
                'code' => config('code.fail'),
                'msg' => '请联系管理员'
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
        if(isset($data['count'])&&!empty($data['count'])){
            $page=$data['count'];
        }else{
        $page=1;}
        if(isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=1;}
        $cate=Db::table('goods')->where('cid',$id)->paginate($limit,false,['page'=>$page]);
        $total=$cate->total();
        $data=$cate->items();
        if($total>0&& count($data)){
            return json([
                'code'=>200,
                'msg'=>'查询成功',
                'data'=>$data,
                'total'=>$total
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>'查询失败',
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
