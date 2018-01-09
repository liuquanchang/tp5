<?php

namespace app\index\model;


class Equipment extends Common
{
	protected  $pk     = 'id';
	protected  $tables = 'qhb_equipment';
	
	public static function get_one(array $where)
	{
		$return_list=[];
		$where      = array_filter($where);
		if(empty($where)){return false;}
		$return_data=self::handler_where($where);
		//dump($return_data);
		/*$data = parent::select(function($query)use($return_data){
			$query->where($return_data);
		})->paginate(2);*/
		$data        = parent::where($return_data)->paginate(2);
		$return_list['lists'] =  $data;
		$return_list['page']  =  $data->render(); 
		return $return_list;	
	}
	private static function handler_where(array $where)
	{	$return_data=[];$miroc ='';
		if(empty($where)){return false;}
		foreach($where as $key=>$value)
		{
			if(empty($value)){continue;}
			if(is_numeric($value)){$miroc='EQ';}
			if(is_string($value)){$miroc='LIKE';$value="%{$value}%";}
			$return_data[$key]  = [$miroc,$value];			
		}
		if(empty($return_data)){return false;}
		return $return_data;		
	}
        
}
