<?php

namespace app\index\model;


class Rent extends Common
{
   public static function get_data($id)
   {
	$data   = parent::get(function($query)use($id){
		$query->where(['id'=>['EQ',$id]]);
	});
	$sql   =   parent::getLastSql();
	if(empty($data)==true){return false;}
	return $data;	
   }
   
   public static function get_cate()
   {
	$where = ['display'=>1,'pid'=>1];
	$order = self::order_data('id.desc');
	$data  = parent::table('qhb_article_class')->where(function($query)use($where){
			$query->where($where);
		})->order($order)->paginate(2);
	$return_data['lists'] = $data;
	$return_data['page']  = $data->render();
	return $return_data;
   }
   protected static  function order_data($field)
   {
	if(is_string($field)==false){parent::$error='抱歉参数错误';}
	$field       =   explode(',',$field);
        $return_data =   [];
	$field       =   array_map(function($element)use(&$return_data){
		list($key,$value) = explode('.',$element);
		$return_data[$key]= strtoupper($value);
	},$field);
	return $return_data;
   }
    //
}
