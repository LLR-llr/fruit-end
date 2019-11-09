<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;
use think\Request;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
//        try {
            $data = $this->request->post();
            $model = model('Users');
            $result = $model->querytel(['tel'=>$data['tel']]);
            if ($result) {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '该手机号已存在'
                ]);
            }
        $result2 = $model->querytel(['nickname'=>$data['nickname']]);
        if ($result2) {
            return json([
                'code' => config('code.fail'),
                'msg' => '该用户名已存在'
            ]);
        }
            $data['password']=md5(crypt($data['password'],config('salt')));
            $users = $model->insert($data);
            if ($users>0) {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '注册成功'
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '注册失败'
                ]);
            }
//        }catch(Exception $exception){
//            return json([
//                'code'=>config('code.fail'),
//                'msg'=>'请联系管理员'
//            ]);
//        }
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
