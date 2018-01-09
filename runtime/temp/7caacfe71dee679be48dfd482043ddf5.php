<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/home/lqc/tp5/public/../application/index/view/search/index.html";i:1481611272;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>组合搜索_列表</title>
<link href="__PUBLIC__/css/search_m.css" rel='stylesheet' type"text/css"/>
<link href="__PUBLIC__/css/style.css"    rel="stylesheet"    type="text/css" />
<link rel="stylesheet" type="text/css" href="/static/css/layer.css" />
      <script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.3.min.js"></script>  
<script type="text/javascript" src="/static/js/layer.js"></script>
<style>
  .layui-layer-btn{font-family:'微软雅黑'}
  .layui-layer-title{font-family:'微软雅黑'}
</style>
<script type="text/javascript">
$(function()
{
	var open_param={type:1,title:'温馨提示',shade:0.6,maxmin:false,anin:1,area:['500px','500px'],content:''};

				$(".l_more").click(function() {
					var length    =   $(".list_content_box").length+1;
					if($(".list_content_box").length > 9){
						return tips('抱歉最多只能添加10项搜索设备！',$(this));
					}
					$("<div  class='list_content_box'><ul><li class='list_11_'>" + length + "</li><li class='list_2_'>|</li><li><input placeholder='请填写搜索关键字' name='data["+length+"][keyword]' type='text' class='inp_list1' /></li><li class='list_2_'>|</li><li><input name='data["+length+"][brand]' placeholder='请填写设备品牌' type='text' class='inp_list2' /></li><li class='list_2_'>|</li><li><input name='data["+length+"][type]' placeholder='请填写设备品牌'  type='text' class='inp_list2' /></li><li class='list_2_'>|</li>  <li><input name='data["+length+"][s_price]' type='text' placeholder='请填写开始价格'  class='inp_list3 m_l' /><div class='inp_m'>-</div><input name='data["+length+"][e_price]' placeholder='请填写结束价格'  type='text' class='inp_list3 m_rr' /></li><li class='list_2_'>|</li><li><div  class='list_dell'></div></li></ul></div>").appendTo(".c_list_:first");
				});
	$(".c_list_").on('click','.list_dell',function(){removedetail(this);})
   	$(".but_one").click(function(){if(confirm("确定重新填写全部信息吗？")){location.href = "search_list_m.html";}});
	function resetNum()
	{
            var len = $('.list_content_box').length;
            for(var i=0;i<len;i++){$(".list_11_:eq("+i+")").text(i+1);}
	};
	var removedetail=function(obj)
	{
		var lenth = $('.list_content_box').length,content='',that=obj;
		if(lenth==1){return tips('抱歉至少需要保留一项！');}
		open_param.content   =  create_content('你确认要删除该项么？');
		open_param.area      =  ['300px','150px'];
		open_param.btn	     =  ['残忍删除','暂不删除'];
		open_param.yes       =  function(index)
		{
			$(that).closest('.list_content_box').remove();	
			resetNum();
			layer.close(index);
		};
		open_param.no        = function(index)
		{
			layer.close(index);
		};
		open_dailog();
	};
	var  tips  = function(info,dom){
		layer.tips(info,dom);
		return false;
	};
	var  create_content=function(contents){
		var outside  =   $('<div>'),inside=outside.clone();
		    outside.css({'font-family':"微软雅黑",'text-align':'center','font-size':'14px'});
		    inside.css({'font-family':'微软雅黑','text-align':'center','font-size':'14px'});
		    inside.text(contents);
		    outside.html(inside.get(0).outerHTML);
		    return outside.get(0).outerHTML;
	};
	var open_dailog=function()
	{
		layer.open(open_param);
	}
});
			
		</script>
      
</head>

<body>
	<div class="top_box">
    	<div class="top_m_box">
        	<div class="top_logo"><a href="#"><img src="__PUBLIC__/image/s_logo.png" width="195" height="47" /></a></div>
            <div class="top_title_l">组合搜索</div>
            <div class="top_title_r"><a href="#">返回首页</a></div>
        </div>
    </div>
    
    <form method="post" name="myform" action="<?php echo url('searchd','','.html',true); ?>" class="validform">
    <div class="cont_box_1200">
        <div class="c_title">搜索设备列表</div>
        <div class="list_title_box">
                    <ul>
                        <li class="list_1_">
                            序号
                        </li>
                        <li class="list_2_">
                            |
                        </li>
                        <li class="list_1_ p_mm">
                            搜索关键字
                        </li>
                        <li class="list_2_">
                            |
                        </li>
                        <li class="list_1_">
                            设备品牌
                        </li>
                        <li class="list_2_">
                            |
                        </li>
                        <li class="list_1_">
                            设备型号
                        </li>
                        <li class="list_2_">
                            |
                        </li>
                        <li class="list_1_ p_mm">
                            价格区间
                        </li>
                        <li class="list_2_">
                            |
                        </li>
                        <li class="list_1_">
                            操作
                        </li>
                    </ul>
                </div>
        
        <div class="c_list_">       
        	<div class="list_content_box">
                <ul>
                <li class="list_11_">
                1
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[1][keyword]" type="text"  placeholder='请填写搜索关键字！'  class="inp_list1" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[1][brand]" type="text" placeholder='请填写设备品牌'  class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[1][type]" type="text" placeholder='请填写设备型号'  class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[1][s_price]" type="text" placeholder='请填写开始价格' class="inp_list3 m_l" />
                <div class="inp_m">-</div>
                <input name="data[1][e_price]" type="text" placeholder='请填写结束价格' class="inp_list3 m_rr" />
                </li>
                <li class="list_2_">
                |
                </li>
                
                <li>
                <div class="list_dell"></div>
                </li>
                </ul>
                </div>
                
        	<div id="target_one" class="list_content_box">
                <ul>
                <li class="list_11_">
                2
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[2][keyword]" type="text" placeholder='请填写搜索关键字' class="inp_list1" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[2][brand]" type="text"   placeholder='请填写设备品牌'   class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[2][type]" type="text"  placeholder='请填写设备型号'  class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[2][s_price]" type="text"   placeholder='请填写开始价格'  class="inp_list3 m_l" />
                <div class="inp_m">-</div>
                <input name="data[2][e_price]" type="text"  placeholder='请填写结束价格'  class="inp_list3 m_rr" />
                </li>
                <li class="list_2_">
                |
                </li>
                
                <li>
                <div class="list_dell"></div>
                </li>
                </ul>
                </div>
                
        	<div id="target_one" class="list_content_box">
                <ul>
                <li class="list_11_">
                3
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[3][keyword]" type="text"  placeholder='请填写收索关键字'  class="inp_list1" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[3][brand]" type="text"   placeholder='请填写设备品牌'  class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[3][type]" type="text"  placeholder='请填写设备型号'  class="inp_list2" />
                </li>
                <li class="list_2_">
                |
                </li>
                <li>
                <input name="data[3][s_price]" type="text"   placeholder='请填写开始价格'  class="inp_list3 m_l" />
                <div class="inp_m">-</div>
                <input name="data[3][e_price]" type="text"    placeholder='请填写结束价格'  class="inp_list3 m_rr" />
                </li>
                <li class="list_2_">
                |
                </li>
                
                <li>
                <div class="list_dell"></div>
                </li>
                </ul>
                </div>
       </div>
                
        <div class="l_more">添加设备</div>
        <div class="l_note">注：最多添加10个搜索设备！</div>
    </div>
    
    <div class="cont_box_1200">
    	<div class="c_title">基本信息</div>
        
        <div class="auth_list_box">
                <div class="auth_l_name">所在地区</div>
                <div class="auth_linp_address">
                	<select name="province" class="input_ser province" datatype="*" nullmsg="请选择地区！" errormsg="请选择地区！" sucmsg="地区选择成功">
                        <option class="option_style" value="">选择省</option>
			<?php if(is_array($province) || $province instanceof \think\Collection): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
			<option value="<?php echo $item['id']; ?>"><?php echo $item['areaname']; ?></option>
			<?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select class="input_ser city" name='city'>
                    	<option value="">选择市</option>
                    </select>
		    <select name='area' class="input_ser area" class='area'>
                    	<option value="">选择区/县</option>
                    </select>             
                    <label for="num_err" class="Validform_checktip"></label>
                </div>
        </div>
        
        <div class="auth_list_box">
                <div class="auth_l_name">所在地区</div>
                <div class="auth_linp_address">
                	<select name="s_province" class="input_ser s_province" datatype="*" nullmsg="请选择地区！" errormsg="请选择地区！" sucmsg="地区选择成功">
                        <option class="option_style" value="">选择省</option>
			<?php if(is_array($province) || $province instanceof \think\Collection): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lo_item): $mod = ($i % 2 );++$i;?>
			<option value="<?php echo $lo_item['id']; ?>"><?php echo $lo_item['areaname']; ?></option>
			<?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select class="input_ser s_city" name="s_city">
                    	<option value="">选择市</option>
                    </select>
		    <select class="input_ser s_area" name="s_area">
                    	<option value="">选择区/县</option>
                    </select>             
                    <label for="num_err" class="Validform_checktip"></label>
                </div>
        </div>
        
        <div class="but_box">
        	<input name="" type="button" class="but_one" value="重新填写" />
            <input name="" type="submit" class="but_two" value="提  交" />      
        </div>    
    </div>
    </form>
    
    <div class="bottom">
     <div class="sever">
         <div class="sever_cont">
           	 <div class="sub_sever_f">
             	<div class="sub_sever_img"><img src="__PUBLIC__/image/but_1.png" width="55" height="55" /></div>
                <div class="sub_sever_inf">
                	<div class="inf_1">省时省力</div>
                    <div class="inf_2">足不出户  抄底优惠</div>
                </div>
             </div>
             <div class="sub_sever_f">
             	<div class="sub_sever_img"><img src="__PUBLIC__/image/but_2.png" width="55" height="55" /></div>
                <div class="sub_sever_inf">
                	<div class="inf_1">品质保障</div>
                    <div class="inf_2">把关为本  以质为根</div>
                </div>
             </div>
             <div class="sub_sever_f">
             	<div class="sub_sever_img"><img src="__PUBLIC__/image/but_3.png" width="55" height="55" /></div>
                <div class="sub_sever_inf">
                	<div class="inf_1">省钱省心</div>
                    <div class="inf_2">把关为本  以质为根</div>
                </div>
             </div>
             <div class="sub_sever_f">
             	<div class="sub_sever_img"><img src="__PUBLIC__/image/but_4.png" width="55" height="55" /></div>
                <div class="sub_sever_inf">
                	<div class="inf_1">省钱省心</div>
                    <div class="inf_2">乐享购物  一惠到底</div>
                </div>
             </div>
             <div class="sub_sever_f">
             	<div class="sub_sever_img"><img src="__PUBLIC__/image/but_5.png" width="55" height="55" /></div>
                <div class="sub_sever_inf">
                	<div class="inf_1">专业团队</div>
                    <div class="inf_2">专业专注  全心服务</div>
                </div>
             </div>
             
         </div>
     </div>
     <div class="detail">
         <div class="detail_cont">
             <div  class="detail_l">
                 <ul>
                     <li class="detail_l_tit">关于机惠</li>
                     <li><a href="#">公司介绍</a></li>
                     <li><a href="#">联系方式</a></li>
                     <li><a href="#">资源合作</a></li>
                     <li><a href="#">招商加盟</a></li>            
                 </ul>
                 <ul>
                     <li class="detail_l_tit">支付服务</li>
                     <li><a href="#">提现流程和规则</a></li>
                     <li><a href="#">机惠豆政策</a></li>
                     <li><a href="#">货到付款</a></li> 
                     <li><a href="#">在线支付</a></li>         
                 </ul>
                 <ul>
                     <li class="detail_l_tit">配送服务</li>
                     <li><a href="#">签收验货</a></li>
                     <li><a href="#">快递配送</a></li>
                     <li><a href="#">物流配送</a></li>       
                 </ul>
                 <ul>
                     <li class="detail_l_tit">售后服务</li>
                     <li><a href="#">订单取消</a></li>
                     <li><a href="#">退款说明</a></li>
                     <li><a href="#">退换货政策</a></li> 
                     <li><a href="#">退换货流程</a></li>          
                 </ul>
                 <ul>
                     <li class="detail_l_tit">供应商服务</li>
                     <li><a href="#">店铺管理</a></li>
                     <li><a href="#">供应商入驻流程</a></li>
                     <li><a href="#">供应商流程</a></li>         
                 </ul>
                 <ul>
                     <li class="detail_l_tit">服务商服务</li>
                     <li><a href="#">服务商认证</a></li>
                     <li><a href="#">服务流程</a></li> 
                     <li><a href="#">轻松接单四部曲</a></li>        
                 </ul>
                 <ul>
                     <li class="detail_l_tit">购物指南</li>
                     <li><a href="#">设备租赁流程</a></li>
                     <li><a href="#">配件购买流程</a></li>
                     <li><a href="#">二手机购买流程</a></li>
                     <li><a href="#">新设备购买流程</a></li>         
                 </ul>
             </div>
             <div class="detail_r">
                     <div class="detail_r_tit">联系我们</div>
                     <div class="telbox">客服电话 : <span class="tel">400-8237-365</span></div>
                     <div class="qqbox">
                         <div class="qqtxt">
                              客服<span class="qq_tit">QQ</span> :
                         </div>
                         <div class="qqnum">
                         <a href="#" class="mr_10">1140365365</a>
                         <a href="#">1140365365</a>
                         </div>
                     </div>
                     <div class="severtime">服务时间 : 8:00Am-20:00Pm</div>
             </div>

         </div>
     </div>
     <div class="verson">
         <div class="verson_cont">
             <div class="abouts">
                 <a href="#">关于我们</a>
                 <a href="#">公司资质</a>
                 <a href="#">法律声明</a>
             </div>
           <div class="links">
                 友情链接：
                 <a href="#">阿里巴巴集团</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>
                 <a href="#">聚划算</a>
                 <a href="#">全球速卖</a>
                 <a href="#">阿里巴巴国际交易市场</a>
                 <a href="#">1688</a>
                 <a href="#">阿里妈妈</a>
                 <a href="#">阿里旅行.去啊</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>
                 <a href="#">聚划算</a>
                 <a href="#">阿里巴巴集团</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>

                 <a href="#">聚划算</a>
                 <a href="#">全球速卖</a>
                 <a href="#">阿里巴巴国际交易市场</a>
                 <a href="#">1688</a>
                 <a href="#">阿里妈妈</a>
                 <a href="#">阿里旅行.去啊</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>
                 <a href="#">聚划算</a>
                 <a href="#">阿里巴巴集团</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>
                 <a href="#">聚划算</a>
                 <a href="#">全球速卖</a>
                 <a href="#">阿里巴巴国际交易市场</a>
                 <a href="#">1688</a>
                 <a href="#">阿里妈妈</a>
                 <a href="#">阿里旅行.去啊</a>
                 <a href="#">天猫</a>
                 <a href="#">淘宝</a>
                 <a href="#">聚划算</a>
             </div>
             <div class="rights">
                 版权所有  机惠网 <a href="">京ICP证010051号</a> 通用网址：<a href="#">hc360</a> Copyright@2000-2013 hc360.com. ALL Rights Reserved
             </div>
             <div class="icons">
                 <ul>
                     <li><img src="__PUBLIC__/image/bottom_1.png" width="84" height="28" /></li>
                     <li><img src="__PUBLIC__/image/bottom_2.png" width="84" height="28" /></li>
                     <li><img src="__PUBLIC__/image/bottom_3.png" width="84" height="28" /></li>
                     <li><img src="__PUBLIC__/image/bottom_1.png" width="84" height="28" /></li>
                     <li><img src="__PUBLIC__/image/bottom_2.png" width="84" height="28" /></li>
                     <li><img src="__PUBLIC__/image/bottom_3.png" width="84" height="28" /></li>
                 </ul>
             </div>
         </div>
     </div>
     
 </div>
	<script type="text/javascript" src="/static/js/area.js"></script>
       	<script type="text/javascript">
		$(function()
		{
			var area_model     	= new area();
			    area_model.dom    	= ['province','city','s_province','s_city'];
			    area_model.selector	= 'class';
			    area_model.uri.area_url = "<?php echo url('linkage','','.html',true); ?>"
			    area_model.init();
		});	
	</script>  
</body>
</html>
