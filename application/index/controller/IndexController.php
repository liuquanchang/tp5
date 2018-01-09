<?php
namespace app\index\controller;
use think\Request;
class IndexController extends CommonController
{
  	public function index(){
		var_dump($this->request->param('name'));
		dump('commomn');
  	}
	
	public function hello($name='world',$city='')
	{
		echo 'hello '.$name.$city;	
	}
}
