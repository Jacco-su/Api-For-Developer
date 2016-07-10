<?php
namespace app\demo\controller;
use app\api\model;
use think\Controller;
class Index extends Controller{
    public function index(){
        return $this->fetch();
    }
}
