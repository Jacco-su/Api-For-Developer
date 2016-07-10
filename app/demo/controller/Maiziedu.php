<?php
namespace app\demo\controller;
use app\api\model;
use think\Controller;
use think\Validate;
use think\Request;
class Maiziedu extends Controller{
    public function _initialize(){
        $data = model\Maiziedu::getCategory();
        $this->assign(['course_list'=>$data]);
    }
    public function index(){
        return $this->fetch();
    }
    public function courses($course){
        $data = model\Maiziedu::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data,'course_title'=>$course]);

        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        return $this->fetch('index',['course_f'=>1]);
    }
    public function lists($course,$cid){
        $data = model\Maiziedu::getVideos($cid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['videos'=>$data,'course_title'=>$course,'course_id'=>$cid]);
        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        $data = model\Maiziedu::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data]);
        return $this->fetch('index',['course_f'=>1,'lists_f'=>1]);
    }
    public function video($course,$cid,$vid){
        $data = model\Maiziedu::getInfo($cid,$vid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['info'=>$data,'course_id'=>$course,'cid'=>$cid,'vid'=>$vid]);
        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        $data = model\Maiziedu::getVideos($cid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['videos'=>$data,'course_id'=>$course,'cid'=>$cid]);
        $data = model\Maiziedu::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data,'course_title'=>$course,'course_id'=>$cid]);
        return $this->fetch('index',['course_f'=>1,'lists_f'=>1,'video_f'=>1]);
    }
}
