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
	else if(@$_SESSION['log']==1)
	{
		include("head2.php");
?>
	<!form name="upload" action="stock2.php" method = "post">
		<!center>
		<!label for="file"><!/label>
		<!input type=file name='file' id='file'>
		<!input type="submit" value="提交" name="sub">
		<!input type="reset" value="清空" name="re"><br>
		<!/center>
	<center>
		<h2>批量入库：</h2><br>
	<form action="stock2.php" method="post" enctype="multipart/form-data">
		<label for="file"></label>
<input type="file" name="file" id="file"> 
<br><div class="btn-group">
  <button type="submit" class="btn btn-primary">提交</button>
  <button type="reset"  class="btn btn-default">清空</button>
</div>
	</form> 
	</center> 
	<!/form>
<?php
	$_SESSION['code']=mt_rand(1,1000);
	include("foot.php");
	}
?>
</body>
</html>
