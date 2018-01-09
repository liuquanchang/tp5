//构造函数
function area()
{
 this.dom   	 	= [];//事件节点的参数
 this.selector    	= 'class';//事件节点的是id选择器还是class选择器还是标签选择器
 this.node          	= '';//节点保存变量
 this.selector_point	= '';//当前的标识
 this.uri	 	= {};//请求的uri队列
}
//初始化函数
area.prototype.init=function()
{
	try{
	 	//添加事件
		this.add_event();
	}catch(e){this.msg('抱歉组件初始化失败！');};	
};
//注册事件
area.prototype.add_event=function()
{
    try{
	var source_event   = this;
	for(var i in this.dom)
	{
		switch(this.selector)
		{
			case 'class':this.selector_point='.';
			break;
			case 'id':this.selector_point='#';
			break;
			default: 
			this.msg('抱歉给的节点系统未录入！');	
		}
		$(this.selector_point+this.dom[i]).change(function(){
			source_event.node   =  $(this);
			source_event.attribute();	
		});
	}
       }catch(e){this.msg('事件组件错误！');};	
};

//分发数据包
area.prototype.attribute=function()
{
    try{
	this.set_options();
	var param   	= {},pid='';
	pid		= this.node.val();
	pid		= $.trim(pid);
	param.pid	= pid;
	if(isNaN(pid)==true){return this.tips('非法参数！');}
	this.send_post(this.uri.area_url,param);
       }catch(e){this.msg('分发组件错误！');};
};

//创建response数据节点
area.prototype.create_option=function(data)
{
	try{
	 if(data.code==0){return this.tips(data.msg,this.node);}
	 var information  =  data.data,html='',options='';
	 $(information).each(function(){
		options  	= $('<option>');options.attr({value:this.id});options.text(this.areaname);
		options		= options.get(0).outerHTML;
		html+=options;
	 });
	 if(html==''){ return this.tips('节点创建异常！');}
	 this.node.next('select').append(html);
	}catch(e){this.msg('节点创建失败！');}	
};
//发送http请求
area.prototype.set_options=function()
{
	try{
	var select = this.node.nextAll('select');
	$(select).each(function(){this.options.length=1;});
	}catch(e){return this.msg('callback请求失败！');}
};
//http请求
area.prototype.send_post=function(uri,param)
{
	try{
	 var source_event     =  this;
	 $.post(uri,param,function(data){
		source_event.create_option(data);
	 });
	}catch(e){this.msg('http请求异常！');}
};
//提示
area.prototype.tips=function(info,dom)
{
	layer.tips(info,dom);return false;
};
//catch 组件提示
area.prototype.msg=function(info)
{
	layer.msg(info,{icon:3,time:2000});
};
