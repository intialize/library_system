<html>
<head>
	<title>Welcome to the library</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta http-equiv="Content-Language" content="zh"/>
	<link rel=stylesheet href="bootstrap.css" type="text/css">
</head>
<body>	
<?php
	include("head2.php");
?>
	<center>
		<form name="login" action="login.php" method = "post">
			<table class="table table-hover">
				<tr class="success">
				<td align=middle>
				账号 <input type="text" name="ID" size="20"><br></td>
				</tr><br>
				<tr class="active">
				<td align=middle>
				密码 <input type="password" name="password" size="20"><br></td>
				</tr><br>
			</table>
<div class="btn-group">
  <button type="submit" class="btn btn-primary">提交</button>
  <button type="reset"  class="btn btn-default">清空</button>
</div>
		</form>
	</center>
</body>
</html>
