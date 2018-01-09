<?php
	namespace app\index\controller;
	use think\controller\Hprose;
	class HproseController extends Hprose
	{
		protected $alias	=	'hello_two';
		public function index()
		{
			return 'i am 192.168.0.159 server you khown so com return me ok??';
		}
		
		public function other($rpcCount,$rpcCountTwo)
		{
			sleep(5);
			return func_get_args();
			
		}
	} 
