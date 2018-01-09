<?php
namespace app\index\controller;
use think\Request;
use think\Url;
class BlogController extends CommonController
{
	
	public function index()
	{
		var_dump(1111);
		exit;
	}

	public function get($id)
	{
		echo Url::build('blog/get', ['id' => 5]).'<br>' ;
		echo 'id is this number :'.$id;
	}

	public function read($name)
	{
		echo Url::build('blog/read',['name'=>'xiaoxiao']).'<br>';
		echo 'rend mark this name :'.$name;	
	}
	
	public function archive($year,$month)
	{
		echo  Url::build('blog/archive',['year'=>2015,'month'=>05]).'<br>';
		echo  url('blog/archive',['year'=>2015,'month'=>20]).'<br>';
		echo  'this yes is :'.$year.'  this month is this month'.$month;
	}

}
?>
