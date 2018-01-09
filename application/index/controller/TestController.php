<?php
namespace app\index\controller;

class TestController  extends CommonController{
	public function index ()
	{
		$data	=	input('param.');
		dump($data);	
		$this->test_swoole($data);
		dump(111);		
	}
	public function test_swoole($data){
		$server		=	new \swoole_client(SWOOLE_SOCK_TCP);
		if($server->connect('192.168.0.159',9501,-1)===false){
			die('连接服务器失败呀我的哥!');
		}
		$data	= array_filter($data);
		if(empty($data)){echo '你妹呀！输入点类容舍!';}
		$data	=json_encode($data);
		$server->send($data);
		echo $server->recv();
		$server->close();
    		sleep(5);
	}	
}
