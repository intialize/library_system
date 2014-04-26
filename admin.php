<html>
<head>
	<title>Query Result</title>
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
	$link = mysql_connect('localhost','root','102030'); 
	if (!$link) 
		die('Could not connect to MySQL:' . mysql_error());
	mysql_select_db('hzb', $link);
	$oper=@$_POST['oper'];
	$card_id=@$_POST['card_id'];
	$reader_name=@$_POST['reader_name'];
	$department=@$_POST['department'];
	$reader_role=@$_POST['reader_role'];
	mysql_query("set names utf8",$link);//显示中文
	$result=mysql_query("select * from card 
						 where card_id='$card_id'");
	if($result)
		$row=mysql_fetch_array($result);
	if(!$oper)
		//未选择操作
			echo "<div class='alert alert-danger'><b><center>没有选择操作<center></b></div>";
	else{
	if($row)
	{
		if($oper=='add')
			echo "<div class='alert alert-danger'><center><b>卡号'$card_id'已存在</b></center></div>";
		else if($oper=='del' && $row['reader_name']==$reader_name)
		//操作为删除但是卡号不存在
		{
			$sql=mysql_query("delete from card where card_id='$card_id'");
			echo "<div class='alert alert-success'><center><b>用户'$reader_name'删除成功</b></center></div>";
		}
		else if($oper=='del' && $row['reader_name']!=$reader_name)
		//操作位删除但是表单提交的读者姓名和数据库中的姓名不相符
			echo "<div class='alert alert-danger'><center><b>卡号'$card_id'存在，但姓名不符</b></center></div>";
	}
	else
	{
		if($oper=='add'&&$card_id&&$reader_name&&$department&&$reader_role)
		//操作为增加且卡号等信息都填写完全
		{
			$sql=mysql_query("insert into card(card_id, reader_name,department,reader_role)
				values ('$card_id','$reader_name', '$department', '$reader_role')");
			echo "<div class='alert alert-success'><b><center>用户'$reader_name'新建成功</center></b></div>";
		}
		else if($oper=='add')
		//操作为增加但卡号等信息都填写不完全
			echo "<div class='alert alert-danger'><b><center>抱歉，用户信息不全</center></b></div>";
		else if($oper=='del')
		//操作为删除
			echo "<div class='alert alert-danger'><b><center>该卡号'$card_id'不存在<center></b></div>";
	//	else if(!$oper)
		//未选择操作
	//		echo "<div class='alert alert-danger'><b><center>没有选择操作<center></b></div>";
	}}
	mysql_close($link); 
?>
	<A HREF="admin_input.php">
	<br><br><center><b>返回上一页<b><center><br>
	</A>
</table>
<?php
	include("foot.php");
	}
?>
</body>
</html>
