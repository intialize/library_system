<html>
<head>
	<title>Stock</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta http-equiv="Content-Language" content="zh"/>
	<link rel=stylesheet href="bootstrap.css" type="text/css">
</head>
<body>
<?php 
	session_start();
	if(@$_SESSION['log']==0)
	{
?>
		<div class="alert alert-danger"><center>您尚未登录</center></div>
		<br><A HREF="index.php"><center>返回</center></A>
<?php
	}	
	else if($_SESSION['log']==1)
	{
		include("head.php");
?>
		<center>
		<h2>单本入库：</h2><br>
		<form name="stock" action="stock1.php" method = "post">
			<table class="table table-hover" align=middle> 
				<tr align=middle><td><input type="text" name="book_id" placeholder="书号"></td></tr>
				<tr align=middle><td><input type="text" name="type" placeholder="类别"></td></tr>
				<tr align=middle><td><input type="text" name="book_name" placeholder="书名"></td></tr>
				<tr align=middle><td><input type="text" name="company" placeholder="出版社"></td></tr>
				<tr align=middle><td><input type="text" name="publish_year" placeholder="出版年份"></td></tr>
				<tr align=middle><td><input type="text" name="auther" placeholder="作者"></td></tr>
				<tr align=middle><td><input type="text" name="price" placeholder="价格" ></td></tr>
				<tr align=middle><td><input type="text" name="quantity" placeholder="数量"></td></tr>
			</table>
			<div class="btn-group">
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset"  class="btn btn-default">清空</button>
			</div>	
	</form><br>
	<div class="alert alert-success">
	*如果库中已有此书，只需输入书名、书号和数量
	</div>
	</center>
<?php
		include("foot.php");
	}
?>
</body>
</html>
