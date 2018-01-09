<?php
namespace app\index\model;
use think\Model;

class Member extends Model{
	protected $pk	=	'id';
	protected $table=	'qhb_member';

	public static function get_one($id)
	{
		$result=parent::fetchSql(false)->find(function($query)use($id){
			$query->where(['id'=>$id]);
		});
		return $result;	
	}

}
?>
