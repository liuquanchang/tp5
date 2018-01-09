<?php
namespace app\index\controller;

class SwooleController extends CommonController
{
	private  $server	=	'';
	public function index()
	{
		if(IS_CLI===false){die('什么情况');}
		$config		=	[
			'worker_num'	=>4,
			'dispatch_model'=>2,
			'task_worker_num'=>4,
			'demonize'	=>false,
			'reactor_num'	=>4,
			'max_request'	=>1000
		];
		$this->server	=	new \swoole_server('0.0.0.0',9501);
		$this->server->set($config);
		$this->server->on('Start',array($this,'OnStart'));
		$this->server->on('WorkerStart',array($this,'OnWorkerStart'));
		$this->server->on('Close',array($this,'OnClose'));
		$this->server->on('Receive',array($this,'OnReceive'));
		$this->server->on('Task',array($this,'OnTask'));
		$this->server->on('Finish',array($this,'OnFinish'));
		$this->server->on('ManagerStart',array($this,'OnManagerStart'));
		$this->server->on('Connect',array($this,'OnConnect'));
		$this->server->on('WorkerStop',array($this,'OnWorkerStop'));
		$this->server->start();
	}
	
	public function OnStart(\swoole_server $server)
	{
		echo "swoole start succed \n";
	}
	
	public function OnWorkerStart(\swoole_server $server,$worker_id)
	{
		if($worker_id==0){
			$this->test_worker();
		}
		echo "worker_id:{$worker_id}\n";
		if($server->taskworker==true){
			echo "task_worker_id :{$server->taskworker}\n";
		}
	}
	
	public function OnClose(\swoole_server $server,$fd,$from_id)
	{
		echo 'client : ( '.$fd .'号 ) '.' 客户端关闭  我开启的是  :( '.$from_id.' )号 worker 进程为他服务的'."\n";
		
	}
	
	public function OnConnect(\swoole_server $server,$fd,$from_id)
	{
		echo 'hello : '.$fd.' 号 client  我开启了: ( '.$from_id." ) 号worker进程为您服务\n";
	}
	
	public function OnManagerStart(\swoole_server $server)
	{
		echo "manager start yes \n";
	}
	
	public function OnReceive (\swoole_server $server,$fd,$from_id,$data){
		$this->server->send($fd,'swoole saed : '.$data ."  处理该消息是来自worker_id 为 ：{$from_id}");
		$data		=['msg'=>$data,'fd'=>$fd,'form_id'=>$from_id];
		$data		=	json_encode($data);
		$task_id	=	$server->task($data);
		var_dump(2222);
	}	
	public function OnworkerStop(\swoole_server $server,$worker_id)
	{
		echo 'worker :'.$worker_id."stop \n";
	}
	
	public function OnTask(\swoole_server $server,$task_id,$src_worker_id,$data)
	{
		echo '来自 :'.$src_worker_id.' 号 给我发送了一个异步处理数据包此数据包为： '.$data.' 我的Task进程号为： '.$task_id ."\n";
		sleep(3);
		$data		=json_decode($data,true);
		var_dump($data);			
	}
	
	public function OnFinish(\swoole_server $server,$task_id,$data)
	{
		echo 'task_id end :'.$task_id.' end ontask give me data is :'.$data;	
	}
	public function test_worker(){
		sleep(5);
	}
}
