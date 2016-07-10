<?php
namespace app\api\controller;
use app\api\model;
use think\Validate;
class Maiziedu
{
    public function category(){
        $data = model\Maiziedu::getCategory();
        return ['error'=>0,'data'=>$data];
    }
    public function courses($id){
        $data = model\Maiziedu::getCourses($id);
        return ['error'=>0,'data'=>$data];
    }
    public function videos($id){
        $data = model\Maiziedu::getVideos($id);
        return ['error'=>0,'data'=>$data];
    }
    public function info($cid,$vid){
        $data = model\Maiziedu::getInfo($cid,$vid);
        return ['error'=>0,'data'=>$data];
    }
    
}