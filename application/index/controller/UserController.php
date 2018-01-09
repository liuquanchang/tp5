<?php
 	namespace app\index\controller;
	use think\controller\Hprose;
	//rpc suer 服务模
	class  UserController extends Hprose
	{
		protected $alias	='user';
		
		public function index()
		{
			echo 'shut up you khown';
		}
		
		public function add(array $data)
		{
			return $data;	
		}
		
		public function get($id)
		{
			return [
				'id'=>12,
				'name'=>'刘权昌',
				'nickename'=>'小小刘',
				'age'=>'23',
				'habbit'=>'vof'
			];		
		}
		//更改服务
		public function update($id,array $data)
		{
			$data['id']	=	$id;
			return $data;	
		}
		
		public function remove($id)
		{
			if(!is_numeric($id)){return false;}
			return 'remove success user id is '.$id;
		}
		
		public function hello($args)
		{
			return 'hello '.$args;
		}
		
		public function swapkeyandvalue($data)
		{
			if(is_array($data))return 	array_flip($data);
			return false;
			
		}
		
		function count_sum($arg_one,$arg_two)
		{
			return $arg_one+$arg_two;
		}
	}
	
