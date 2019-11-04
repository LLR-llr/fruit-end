<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2019/10/30
 * Time: 19:56
 */

namespace app\common\model;


use think\Model;

class Goods extends Model
{
    protected $autoWriteTimestamp=true;
    public function add($data){
        return $this->save($data);
    }
    public function goodsquery(){
        return $this->select();
    }
    public function del($id){
        return $this->where('id',$id)->delete();
    }
    public function editquery($id){
        return $this->field('gname,thumb,banner,detail,description,gprice,sale,stock,brand,norms,cid')->where('id',$id)->find();
    }
    public function editupdate($data,$id){
        return $this->save($data,['id'=>$id]);
    }
}
