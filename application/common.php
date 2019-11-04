<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\JWT;
/**
 * 校验token
 * 1.接收token
 *      headers   get   post => token
 *      1.1 判断 token是否存在
 * 2.校验token
 *      JWT::verify('','')
 */

function checkToken(){
    $token=request()->header('token');
    $gettoken=request()->get('token');
    $posttoken=request()->post('token');


    if($token){
        $auth=$token;
    }else if($gettoken){
        $auth=$gettoken;
    }else if($posttoken){
        $auth=$posttoken;
    }else{
        json([
            'code'=>401,
            'msg'=>'token不存在'
        ])->send();
        exit();}

    $result=JWT::verify($auth,config('key'));
    if(!$result){
        json([
            'code'=>401,
            'msg'=>'token验证失败'
        ]);
        exit();
    }
}


