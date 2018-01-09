<?php
	namespace app\index\controller;
	use think\controller\WebsocketHprose;
	class WebsocketServerController extends WebsocketHprose
	{
		protected $scheme	=	'tcp://0.0.0.0:9502';
		protected $alias	=	'tcp_socket';
		public function index($name)
		{
			return $name.' ask you  hello websocket server';
		}
		
		public function fuck($args,$argsTwo)
		{
			return func_get_args();	
		}
	}
