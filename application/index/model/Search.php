<?php

namespace app\index\model;
use \phpanalysis\PhpAnalysis;
class Search extends Common
{
	private static $param	=	[];
	private static $map	=	[];
	public static  function  search_index($data){
		$line_data 	= array_values($data['data']); unset($data['data']);
		self::$param	= array_filter($data);
		$public_where	= self::public_where($data);
		$where		= self::handler_where($public_where,$line_data);
		exit;
		$data		= self::get_list($where);
		return $data;
	}
	//处理搜索的条数
	private static function handler_where($public_where,array $data)
	{
		$handle_data	= array_map(function(&$element){
			$element=array_filter($element);
			return $element;
		},$data);
		self::my_where($public_where,array_filter($handle_data));
		
	}
	//分发处理方法
	public static function  my_where($public_where=array(),$data_where=array())
	{
		if(!empty($data_where))
		{	
			$data			=	[];
			foreach($data_where as $key=>$value)
			{
				self::$map	=	$value;
				$where		=	[];
				if(!empty($value['type'])) {$where['type']=['eq',$value['type']];}
				if(!empty($value['brand'])){$where['brand']=['eq',$value['brand']];}
				if(!empty($value['keyword'])){$where['title']=self::keyword($value['keyword']);}
				if(empty ($value['e_price'])&& !empty($value['s_price']))
				{$where['price_data']=['EGT',$value['s_price']];}
				if(empty ($value['s_price'])&& !empty($value['e_price']))
				{$where['price_data']=['ELT',$value['e_price']];}
				if(!empty($value['s_price'])&&!empty($value['e_price'])) 
				{$where['price_data']=['BETWEEN',"{$value['s_price']},{$value['e_price']}"];}
				$data[]		=	self::get_list($where,$public_where);
			}
			return $data;
		}
		if(empty($data_where)&& !empty($public_where)){return self::get_one(array(),$public_where);}
		
	}
	//处理公共的条件
	private static function public_where(array $public_data)
	{
		$public_data	= array_filter(array_map('trim',$public_data));
		if(empty($public_data) || !is_array($public_data)){return false;}
		$pregx		= '/^s_(province|city|area)/';$new_area=[];
		foreach($public_data as $key=>$value):
			if(preg_match($pregx,$key)==1){$new_area[str_replace('s_','',$key)]=$value;unset($public_data[$key]);}
			continue;
		endforeach;
		if(!empty($public_data)){$shop_id 	= self::handler_area($public_data);}
		if(!empty($new_area))	{$string	= 'CONCAT(",",area_id,",") REGEXP "[^0-9]+('.implode('|',$new_area).')[^0-9]+"';}
		$return_data['uid']=$shop_id;$return_data['area_id']=$string;
		return $return_data;
	}
	//处理当前的区域
	public static function handler_area($data)
	{
		if(!empty($data['area']))
		{$where['area']=['eq',$data['area']];}
		elseif(!empty($data['city']))
		{$where['city']=['eq',$data['city']];}
		elseif(!empty($data['province']))
		{$where['province']=['eq',$data['province']];}
		return $shop_id	=  self::shop_mark('uid',$where);
	}
	//拿到店铺信息或者是商家信息
	public static function shop_mark($field=true,$where=array())
	{
		$data		= parent::name('shop')->where(function($query)use($where){
					$query->where($where);
				})->field($field)->select();
		$shop_id	= [];
		foreach($data as $value){$shop_id[]=$value->uid;};
		if(empty($shop_id)){return false;};
		$shop_id	=implode(',',$shop_id);
		return $shop_id;
	}
	//处理关键字猜词 
	private static function  keyword($key)
	{
		if($key===''){return false;}
		$analy			= new PhpAnalysis();
		$analy::$loadInit	= false;
		$analy->LoadDict();$analy->SetSource($key);$analy->StartAnalysis(false);
		$keyword		= $analy->GetFinallyResult();
		$keyword		= array_filter(explode(' ',$keyword));
		$keyword_hanld		= array_walk($keyword,"self::handler_key");
		$keyword_handler	= implode(' ',$keyword);
		$keyword_handler	= rtrim($keyword_handler,' AND');
		if(empty($keyword_handler)){return false;}
		return $keyword_handler;
	}
	//callback函数
	private  static function handler_key(&$value,$key)
	{
		$value			= "title like '%{$value}%' AND";	
		return 			$value;
	}
	//获得批量搜索的数据
	public static function get_list($where=array(),$public_where=array())
	{
		$map		=	array_merge(self::$map,self::$param);
		$data	=parent::name('Rent')->where(function($query)use($where,$public_where){
			if(!empty($where['title'])){$query->where($where['title']);unset($where['title']);}
			if(!empty($public_where['area_id'])){$query->where($public_where['area_id']);}
			if(!empty($public_where['uid'])){$where['uid']=['IN',$public_where['uid']];}
			$query->where($where);		
		})->paginate(15,false,['query'=>$map]);
		$return_data['lists']=$data;$return_data['page']=$data->render();
		return $return_data;  
	}
	//获得单一收索的数据
	public static function get_one($where,$public_where)
	{
		
	}
}
