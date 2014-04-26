<html>
<head>
	<title>Login Page</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta http-equiv="Content-Language" content="zh"/>
	<link rel=stylesheet href="bootstrap.css" type="text/css">
</head>
<body>
<?php 
	session_start();
	$link = mysql_connect('localhost','root','102030'); 
	if (!$link) 
		die('Could not connect to MySQL:' . mysql_error());
	mysql_select_db('hzb', $link);
	$name=@$_POST['ID'];
	$pwd=@$_POST['password'];
	$_SESSION['ID']=$name;
	if(@$_GET['action']=="logout")
	{
/*		unset($_SESSION['ID']);
		unset($_SESSION['password']);	
		$_SESSION['log']=0;
*/
		session_destroy();//删除session中的信息
		echo "注销成功";
		header("Location:index.php");
	}
	else
	{
		$set="select * from admin 
			where admin_id='$name' and admin_pwd='$pwd'";
		//查看提交的用户名和密码是否在数据库中
		$result=mysql_query($set,$link);
		if($result)
		{
			$row=mysql_fetch_array($result);
			if($row)
			{	
				$_SESSION['log']=1;
				header("Location:operation.php");
			}
			else
			{
?>
	<div class="alert alert-danger" align=middle>用户名或密码错误</div>
	<div class="alert alert-info" align=middle>
	<a href="index.php">
	<center>返回</center>
	</a>
	</div>
<?php
			}
		}
	}
	mysql_close($link); 
?> 
</body>
</html>
