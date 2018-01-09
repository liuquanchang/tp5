<?php

namespace app\index\model;

class Area extends Common
{
    	public  function get_area($field=true,$pid=0)
	{
	  $id	 =intval($pid);
	  $where =['parentid'=>['eq',$id]];
	  $data  = parent::where(function($query)use($where){
			$query->where($where);
		})->field($field)->select();
	  if(empty($data)){$this->error='抱歉没有改地区信息';return false;}
	  return  $data; 
	}
}
