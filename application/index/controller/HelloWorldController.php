<?php
namespace app\index\controller;
use think\Request;
class HelloWorldController extends CommonController{
	public function index()
	{
		var_dump('helloWorld');
		die();
	}
}
?>
