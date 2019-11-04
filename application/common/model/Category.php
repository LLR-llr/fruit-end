<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2019/10/30
 * Time: 15:34
 */

namespace app\common\model;


use think\Model;

class Category extends Model
{
    public function insert($data){
        $data['create_time']=time();
        $data['update_time']=time();
        return $this->save($data);
    }
    public function query(){
        return $this->select();
    }
    public function del($id){
        return $this->where('id',$id)->delete();
    }
    public function editquery($id){
        return $this->where('id',$id)->field('cname,sort,thumb')->find();
    }
    public function editupdate($data,$id){
        return $this->save($data,['id'=>$id]);
    }
}
