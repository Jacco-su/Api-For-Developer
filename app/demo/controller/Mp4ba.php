<?php
namespace app\demo\controller;
use app\api\model;
use think\Controller;
class Mp4ba extends Controller{
    public function _initialize(){
        $data = model\Mp4ba::getCategory();
        $this->assign(['category_list' => $data]);
    }

    public function index(){
        return $this->fetch();
    }
    public function lists($cid=0,$page=1){
        $data = model\Mp4ba::getLists($cid,$page);
        $this->assign(['data' => $data]);
        return $this->fetch('index',['cid'=>$cid,'page'=>$page,'lists_f'=>1]);
    }
    public function item($id){
        $data = model\Mp4ba::getItem($id);
        $this->assign(['item' => $data]);
        return $this->fetch('index');
    }
}