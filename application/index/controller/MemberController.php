<?php
namespace app\index\controller;
use think\Request;
use app\index\model\Member;
class MemberController extends CommonController
{
	public function _initialize(){
		$result	=	Member::get_one(1076);
		Request::instance()->bind('member',$result);
	}
	
	public function GetMember(Request $request)
	{
		var_dump($request->member->id);
		var_dump($request->member->telphone);
		echo "<hr>";
                echo $request->method().'<br>';
		echo  $request->type().'<br>';
		echo $request->ip()."<br>";
		echo '<hr> <pre>';
		dump($request->server());
		dump($request->server('DOCUMENT_URI')).'<br/>';
		dump($request->module());
		dump($request->controller());
		dump($request->action());
		exit;
	}

}

?>
