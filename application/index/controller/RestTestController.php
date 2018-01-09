<?php
namespace app\index\controller;
use think\controller\Rest;
use think\Response;
class RestTestController extends Rest{
	public function rest()
	{
		$method	=	$this->method;
		switch($this->method)
		{
			case 'get':
			$this->get_handler();
			break;
			case 'post':
			$this->post_hanlder();
			case 'put':
			$this->put_test();
			break;
			case 'delete':
			$this->delete_handler();
			break;
			case 'patch':
			$this->patch_handler();
			break;
		}
		
	} 

	public function get_handler()
	{
		dump($this->method);
		exit;
	}
	
	public function post_hanlder()
	{
		dump($this->method);
		exit;
	}
	
	public function delete_hanlder()
	{
		dump($this->method);
		exit;
	}
	
	public function patch_handler()
	{
		dump($this->method);
		exit;
	}
	public function put_test(){
		var_dump($this->method);
		exit;
	}
}
?>
