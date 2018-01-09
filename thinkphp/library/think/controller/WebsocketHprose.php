<?php
 	namespace think\controller;
	use Hprose\Socket\Server;
	class WebsocketHprose
	{
		protected $server	=	'';
		protected $scheme	=	'';
		protected $alias	=	'';
		public function __construct()
		{
			//var_dump($this->alias,$this->sheme);
			//exit;
			$this->server	=	new Server($this->scheme);
			$uri_info	=	parse_url($this->scheme);
			$scheme		=	$uri_info['scheme'];
			$onEvents	=	['onBeforeInvoke','AfterInvoke','onSendError'];
			$other		=	['onAccept','onClose'];
			$accept_shceme	=	['tcp','websocket'];
			if(!in_array($scheme,$accept_shceme))
			{
				$onEvents	=	array_merge($onEvents,$other);
			}
			foreach($onEvents as $value)
			{
				$this->server->$value	=[$this,$value];
			}
			$this->server->addInstanceMethods($this,null,$this->alias);
			$this->server->start();
		}
	}
