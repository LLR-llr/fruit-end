<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2019/11/7
 * Time: 14:33
 */

namespace app\common\model;


use think\Model;

class Users extends Model
{
    protected $table='users';
    protected $autoWriteTimestamp=true;
    public function insert($data){
        return $this->allowField(true)->save($data);
    }
    public function querytel($where=[]){
        return $this->where($where)->select();
    }
}
