<html>
<head>
	<title>Query</title>
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
	include("head.php");
?>
	<center><h2>图书查询</h2></center>
	<form class="navbar-form navbar-middle" role="search" name="select" align=middle action="select.php" method = "post">
			<center>
			<input type="radio" name="way"  value="book_id">书号
			<input type="radio" name="way"  value="book_name">书名
			<input type="radio" name="way"  value="type">类别
			<input type="radio" name="way"  value="company">出版社
			<input type="radio" name="way"  value="publish_year">出版年份
			<input type="radio" name="way"  value="auther">作者
			<input type="radio" name="way"  value="price">价格<br><br>
			<input type="text" name="info" class="form-control"size="40">
			<input type="text" name="price1" class="form-control" size="5">
			<input type="text" name="price2" class="form-control"size="5">
			<select name="order" class="form-control">
			<option value="book_id" selected>书号</option>
			<option value="book_name">书名</option>
			<option value="type">类别</option>
			<option value="company">出版社</option>
			<option value="publish_year">出版年份</option>
			<option value="auther">作者</option>
			<option value="price">价格</option>
			</select>
			<br><br>
<div class="btn-group">
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset" class="btn btn-default">清空</button>
</div>		
	<br><br>
	<div class="alert alert-success">
	*可通过下拉菜单选择排序条件
	<br>*若按价格查询，请在两个小框中输入价格范围，否则在大框中输入
	</div>	
	</form>
<?php
	$_SESSION['code']=mt_rand(1,1000);
	include("foot.php");
	}
?>
	</center>
</body>
</html>
