<?php
namespace app\readme\controller;
use think\Controller;
use think\Request;
class Index extends Controller{
	public function index(){
		return $this->fetch();
	}
	public function codingke(){
		if(Request::instance()->isAjax()){
			return $this->fetch();
		}
		return $this->fetch('index',['mod'=>'codingke']);
	}
	public function maiziedu(){
		if(Request::instance()->isAjax()){
			return $this->fetch();
		}
		return $this->fetch('index',['mod'=>'maiziedu']);
	}
	public function jikexueyuan(){
		if(Request::instance()->isAjax()){
			return $this->fetch();
		}
		return $this->fetch('index',['mod'=>'jikexueyuan']);
	}
	public function mp4ba(){
		if(Request::instance()->isAjax()){
			return $this->fetch();
		}
		return $this->fetch('index',['mod'=>'mp4ba']);
	}
}
