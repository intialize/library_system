<html>
<head>
	<title>Stock</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta http-equiv="Content-Language" content="zh"/>
	<link rel=stylesheet href="bootstrap.css" type="text/css">
</head>
<body link="#0000ff" vlink="#0000ff" alink="#0000ff">
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
		<br>
		<center><A style='text-decoration: none' HREF="stock_in1.php">
		<h3><b>
		图书单本入库</b></h3>
		</A></center>
		<center><A style='text-decoration: none' HREF="stock_in2.php">
		<h3><b>
		图书批量入库</b></h3><br>
		</A></center>
	</center>
<?php
	include("foot.php");
	}
?>
</body>
</html>
