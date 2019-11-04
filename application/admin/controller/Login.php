<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/29
 * Time: 10:23
 */

namespace app\admin\controller;


use think\Config;
use think\Controller;
use think\Db;
use think\Exception;
use think\JWT;

class Login extends Controller
{
    public function index(){
        try{
            $data=$this->request->post();
            $salt=config('salt');
            $password=$data['password'];
//        $data['password']=md5(crypt($password,md5($salt)));
//            $data['password']=md5($password);
//        echo $data['password'];
            $result=Db::table('manager')->where($data)->find();
//        print_r($result);
            if($result){
                $payload=['id'=>$result['id'],'names'=>$result['names']];
                $token=JWT::getToken($payload,config('key'));

                return json([
                    'code'=>config('code.success'),
                    'msg'=>'登录成功',
                    'data'=>[
                        'token'=>$token,
                        'names'=>$result['names']
                    ]
                ]);
            }else{
                return json([
                    'code'=>config('code.fail'),
                    'msg'=>'登录失败'
                ]);
            }
        }catch(Exception $exception){

        }

    }
}
