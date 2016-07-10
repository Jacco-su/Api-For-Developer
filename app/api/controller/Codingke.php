<?php
namespace app\api\controller;
use app\api\model;
use think\Validate;
class Codingke
{
    public function courses($id){
		$validate = new Validate([
			'id'=>'in:ios,android,swift,cocos2dx',
		],[
			'id'=>'课程不在范围内',
		]);
		$data = [
			'id'  => $id,
		];
		if (!$validate->check($data)) {
			return ['error'=>1,'msg'=>$validate->getError()];
		}
    	$data = model\Codingke::getCourses($id);
		if($data==null)return ['error'=>1,'msg'=>'非法参数'];
		return ['error'=>0,'data'=>$data];
    }
    public function videos($id){
		$validate = new Validate([
			'id'=>'regex:\d+',
		],[
			'id'=>'参数错误',
		]);
		$data = [
			'id'  => $id,
		];
		if (!$validate->check($data)) {
			return ['error'=>1,'msg'=>$validate->getError()];
		}
		$data = model\Codingke::getVideos($id);
		if($data==null)return ['error'=>1,'msg'=>'非法参数'];
		return ['error'=>0,'data'=>$data];
    }
    public function info($cid,$vid){
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
			return ['error'=>1,'msg'=>$validate->getError()];
		}
		$data = model\Codingke::getInfo($cid,$vid);
    	if($data==null)return ['error'=>1,'msg'=>'非法参数'];
    	return ['error'=>0,'data'=>$data];
    }
}
