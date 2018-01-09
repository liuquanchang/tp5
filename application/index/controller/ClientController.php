<?php
namespace app\index\controller;

class ClientController
{
	public $client		=	'';
	public function index(){
		if(IS_CLI===false){die('抱歉需要在CLI模式是运行在程序');}
		$this->client	=	new \swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);
		$this->client->on('Connect',array($this,'OnConnect'));
		$this->client->on('Close',array($this,'OnClose'));
		$this->client->on('Receive',array($this,'OnReceive'));
		$this->client->on('Error',array($this,'OnError'));
		$this->client->connect('192.168.0.159',9501);
		exit;
	}
	
	public function OnConnect(\swoole_client $client)
	{
		echo "connect : success \n";
		fwrite(STDOUT,'请输入消息：');
		$msg	= trim(fgets(STDIN));
		$this->client->send($msg);
	}
	
	public function OnClose(\swoole_client $client)
	{
		echo  "connect : close \n";		
	}
	
	public function OnReceive(\swoole_client $client,$data)
	{
	 	 echo $data."\n";	
	}
	
	public function OnError(\swoole_client $client)
	{
		echo "client error \n";	
	}
}
