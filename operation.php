<html>
<head>
	<title>Query Input</title>
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
?>
	<center>
	<br><br><br><br><br><br>
	<A HREF="select_input.php">
	<IMG SRC="a.png" align=center ALT="error" Height=60 width=160 border=0>
	</A>
	<A HREF="stock_input.php">
	<IMG SRC="b.png" align=center ALT="error" Height=60 width=160 border=0><br><br><br><br>
	</A>
	<A HREF="borrow_input.php">
	<IMG SRC="c.png" align=center ALT="error" Height=60 width=160 border=0>
	</A>
	<A HREF="return_input.php">
	<IMG SRC="d.png" align=center ALT="error" Height=60 width=160 border=0><br><br><br><br>
	</A>
	<A HREF="admin_input.php">
	<IMG SRC="e.png" align=center ALT="error" Height=60 width=160 border=0>
	</A>
	<A HREF="login.php?action=logout">
	<IMG SRC="f.png" align=center ALT="error" Height=60 width=160 border=0>
	</A>
	</center>
<?php
	}
?>
	</center>
</body>
</html>
