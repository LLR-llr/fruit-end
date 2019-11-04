<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/29
 * Time: 16:52
 */

namespace app\admin\validate;

use think\Validate;
//use think\Controller;

class Category extends Validate
{
    protected $rule=[
        'cname'=>'require|min:2|max:4',
        'thumb'=>'require',
        'sort'=>'require|number'
    ];
    protected $message=[
        'thumb'=>'缩略图必填',
        'cname.require'=>'cname必填',
        'cname.min'=>'cname最少两个字符'
    ];
   protected $scene=[
       'insert'=>['cname','thumb','sort']
   ];
}