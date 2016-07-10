<?php
namespace app\api\controller;
use app\api\model;
use think\Validate;
class Mp4ba
{
    public function home(){
    	return ['error'=>0,'title'=>'高清Mp4吧'];
    }
    public function category(){
        $data = model\Mp4ba::getCategory();
        if($data==null)return ['error'=>1,'msg'=>'非法参数'];
        return ['error'=>0,'data'=>$data];
    }
    public function lists($category=0,$page=1){
        $validate = new Validate([
            'category'=>'number',
            'page'=>'number',
        ],[
            'category'=>'category非法参数',
            'page'=>'page非法参数',
        ]);
        $data = [
            'category'=>$category,
            'page'=>$page,
        ];
        if (!$validate->check($data)) {
            return ['error'=>1,'msg'=>$validate->getError()];
        }
        $data = model\Mp4ba::getLists($category,$page);
        if($data==null)return ['error'=>1,'msg'=>'非法参数'];
        return ['error'=>0,'data'=>$data];
    }
    public function item($id){
        $validate = new Validate([
            'id'=>'regex:[0-9a-z]{40}',
        ],[
            'id'=>'id非法参数',
        ]);
        $data = [
            'id'=>$id,
        ];
        if (!$validate->check($data)) {
            return ['error'=>1,'msg'=>$validate->getError()];
        }
        $data = model\Mp4ba::getItem($id);
        if($data==null)return ['error'=>1,'msg'=>'非法参数'];
        return ['error'=>0,'data'=>$data];
    }
}