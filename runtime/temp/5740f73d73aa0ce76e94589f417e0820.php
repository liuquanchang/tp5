<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/home/lqc/tp5/public/../application/index/view/search/test.html";i:1481027039;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/static/js/angular.min.js"></script>
</head>
<body>
<div ng-app='hd' ng-controller='area'>
<select ng-model='province' ng-options='v.value as v.name  for v in data' >
<option value=''>请选择</option>
</select>
<span ng-bind='data'></span>
<span ng-bind='province'></span>
<div>
<script type='text/javascript'>
var area  = angular.module('hd',[])
area.controller('area',['$scope',function($scope){
     console.debug(angular.version);
     $scope.data =[{name:'上海市',value:32456},{name:'四川省',value:7447}]
}]);
</script>
</body>
</html>
