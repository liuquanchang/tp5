<?php
	namespace think\controller;
	use Hprose\Http\Server;
	use think\Request;
	class Hprose{
		protected $alias	='';//为了避免方法的冲突我们可以在外不设置。。默认就是当前的的服务器域名或者是当前的class名称前提是controller的民称没有相同的
		public function __construct(){
			$server	=	new Server();
			$server->addInstanceMethods($this,null,$this->alias);
			$server->handle();
		}
	}
