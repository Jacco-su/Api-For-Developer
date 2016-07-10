<?php
namespace app\api\controller;
use app\api\model;
class Jikexueyuan{
	public function type(){
		$data = model\Jikexueyuan::getType();
		if($data==null)return ['error'=>1,'msg'=>'非法参数'];
		return ['error'=>0,'data'=>$data];
	}
    public function courses($type='',$page=1){
		$data = model\Jikexueyuan::getCourses($type,$page);
		if($data==null)return ['error'=>1,'msg'=>'非法参数'];
		return ['error'=>0,'data'=>$data];
    }
    public function videos($id){
		$data = model\Jikexueyuan::getVideos($id);
		if($data==null)return ['error'=>1,'msg'=>'非法参数'];
		return ['error'=>0,'data'=>$data];
    }
    public function info($cid,$vid){
		$data = model\Jikexueyuan::getInfo($cid,$vid);
    	if($data==null)return ['error'=>1,'msg'=>'非法参数'];
    	return ['error'=>0,'data'=>$data];
    }
}
