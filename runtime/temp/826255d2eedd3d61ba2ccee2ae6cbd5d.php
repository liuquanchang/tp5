<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/home/lqc/tp5/public/../application/index/view/uploade/test.html";i:1481687903;}*/ ?>
<html>
<head>
<title>linux服务器上传本地</title>
<script type="text/javascript" src="/static/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.form.js"></script>
</head>
<body>
<div>
<form method='post' id='upFile' action='http://c.jihui365.cn/fitting/up.html' enctype='multipart/form-data'>
<input type='file' name='file' onchange='Upload(this,"upFile")'/><br/>
<input type='submit' value='提交'>
</form>
</div>
<script type='text/javascript'>
function Upload(eve,form){
	var param     	= {},token='<?php echo $secret; ?>';
	param.type	='post';
	param.dataType	='json';
	param.data	={token:token};
	param.url	='http://test.jihui365.cn/fitting/up.html';
	param.success	=function(data){
		console.debug(data);
	}
	param.error	=function(xhr){
		console.debug(xhr);
	}
 	$('#'+form).ajaxSubmit(param);
	$.post('http://c.jihui365.cn/fitting/up.html',{name:'小花',age:19},function(){
	})
}
$(function(){
       	
	var token	="<?php echo $secret; ?>";
 	$.post('http://c.jihui365.cn/fitting/up.html',{name:'小花',age:19,token:token},function(){
		
	});
 }); 
</script>
</body>
</html>
