<html>
<head>
	<title>Card Management</title>
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
		<center><h2>图书证管理</h2></center>
		<form name="stock" action="admin.php" method = "post">
		<input type="radio" name="oper" value="add">增加用户
		<input type="radio" name="oper" value="del">删去用户
		<br><br>
		<table class="table table-hover">
			<tr align="middle"><td>卡号<input type="text" name="card_id"></td></tr>
			<tr align="middle"><td>姓名<input type="text" name="reader_name"></td></tr>
			<tr align="middle"><td>单位<input type="text" name="department"></td></tr>
			<tr align="middle"><td>类别<input type="text" name="reader_role"></td></tr>
		</table>	
<div class="btn-group">
  <button type="submit" class="btn btn-primary">提交</button>
  <button type="reset"  class="btn btn-default">清空</button>
</div><center>
		</form>
	</center>
	<center><br>
	<div class="alert alert-success">
		*若要删去图书证，只需输入卡号和姓名
	</div>
<?php
	include("foot.php");
	}
?>
</body>
</html>
