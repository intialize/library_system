<html>
<head>
	<title>Borrow</title>
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
		include("head2.php");
	?>
		<center><h2>图书借出</h2></center>
	<br><center>
		<form name="return" action="borrow.php" method = "post">
			<table class="table table-hover"><tr><td align=middle>卡号<input type="text" name="card_id" size="20"></td></tr></table>
<div class="btn-group">
  <button type="submit" class="btn btn-primary">提交</button>
  <button type="reset"  class="btn btn-default">清空</button>
</div>
		</form>
	</center>
<?php
	include("foot.php");
	}
?>
</body>
</html>
