<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;


class Category extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        checkToken();
    }

    public function index()
    {
//        echo 123;
//        $model=model('Category');
//        $result=$model->query();
//        dump($result);
//        $count=count($result);
        $result=Db::table('category')->select();
        if($result>0){
            return json([
                'code'=>config('code.success'),
                'msg'=>'查找成功',
                'data'=>$result,
            ]);
        }else{
            return json([
                'code'=>config('code.fail'),
                'msg'=>'查找失败'
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
        echo 'create';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data=input('post.');
        $validate=validate('category');
        if(!$validate->scene('insert')->check($data)){
            return json([
                'code'=>config('code.fail'),
                'msg'=>$validate->getError()
            ]);
        }

        $model = model('Category');
        $result=$model->insert($data);

//        dump($result);


//        $data['create_time']=time();
//        $data['update_time']=time();
//        $result=Db::table('category')->insert($data);
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
        $model = model('Category');
        $result=$model->editquery($id);
//        var_dump($result);
//        $result=Db::table('category')->where('id',$id)->find();
        if($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '查找成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code' => config('code.fail'),
                'msg' => '查找失败'
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
        echo 'edit';
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
        $model = model('Category');
        $result=$model->editupdate($data,$id);

//        $result=Db::table('category')->where('id',$id)->update($data);
        if($result>0) {
            return json([
                'code' => config('code.success'),
                'msg' => '更新成功'
            ]);
        }else{
            return json([
                'code' => config('code.fail'),
                'msg' => '更新失败'
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
        $model=model('Category');
        $result=$model->del($id);

//        var_dump($id);
//        $result=Db::table('category')->where('id',$id)->delete();
        if($result>0) {
            return json([
                'code' => config('code.success'),
                'msg' => '删除成功'
            ]);
        }else{
            return json([
                'code' => config('code.fail'),
                'msg' => '删除失败'
            ]);
        }
    }
}

