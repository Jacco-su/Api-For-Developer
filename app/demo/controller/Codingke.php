<?php
namespace app\demo\controller;
use app\api\model;
use think\Controller;
use think\Validate;
use think\Request;
class Codingke extends Controller{
    public function _initialize(){
        $data = [
            ['id'=>'ios','title'=>'ios'],
            ['id'=>'android','title'=>'android'],
            ['id'=>'swift','title'=>'swift'],
            ['id'=>'cocos2dx','title'=>'cocos2dx'],
        ];
        $this->assign(['course_list'=>$data]);
    }
    public function index(){
        return $this->fetch();
    }
    public function courses($course){

        $validate = new Validate([
            'course'=>'in:ios,android,swift,cocos2dx',
        ],[
            'course'=>'课程不在范围内',
        ]);
        $data = [
            'course'  => $course,
        ];
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $data = model\Codingke::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data,'course_title'=>$course]);

        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        return $this->fetch('index',['course_f'=>1]);
    }
    public function lists($course,$cid){
        $validate = new Validate([
            'id'=>'regex:\d+',
        ],[
            'id'=>'参数错误',
        ]);
        $data = [
            'id'  => $cid,
        ];
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $data = model\Codingke::getVideos($cid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['videos'=>$data,'course_title'=>$course,'course_id'=>$cid]);
        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        $validate = new Validate([
            'course'=>'in:ios,android,swift,cocos2dx',
        ],[
            'course'=>'课程不在范围内',
        ]);
        $data = [
            'course'  => $course,
        ];
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $data = model\Codingke::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data]);
        return $this->fetch('index',['course_f'=>1,'lists_f'=>1]);
    }
    public function video($course,$cid,$vid){
        $validate = new Validate([
            'cid'=>'regex:\d+',
            'vid'=>'regex:\d+',
        ],[
            'cid'=>'参数错误',
            'vid'=>'参数错误',
        ]);
        $data = [
            'cid'  => $cid,
            'vid'  => $vid,
        ];
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $data = model\Codingke::getInfo($cid,$vid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['info'=>$data,'course_id'=>$course,'cid'=>$cid,'vid'=>$vid]);
        if(Request::instance()->isAjax()){
            return $this->fetch();
        }
        $validate = new Validate([
            'cid'=>'regex:\d+',
            'course'=>'in:ios,android,swift,cocos2dx',

        ],[
            'cid'=>'参数错误',
            'course'=>'课程不在范围内',
        ]);
        $data = [
            'cid'  => $cid,
            'course'  => $course,
        ];
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $data = model\Codingke::getVideos($cid);
        if($data==null)return $this->error('非法参数');
        $this->assign(['videos'=>$data,'course_id'=>$course,'cid'=>$cid]);
        $data = model\Codingke::getCourses($course);
        if($data==null)return $this->error('非法参数');
        $this->assign(['courses'=>$data,'course_title'=>$course,'course_id'=>$cid]);
        return $this->fetch('index',['course_f'=>1,'lists_f'=>1,'video_f'=>1]);
    }
}
