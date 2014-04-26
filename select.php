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
	$link = mysql_connect('localhost','root','102030'); 
	if (!$link)
		die('Could not connect to MySQL:' . mysql_error());
	mysql_select_db('hzb', $link);
	mysql_query("set names utf8",$link);
	$way=@$_POST['way'];
	$info=@$_POST['info'];
	$price1=@$_POST['price1'];
	$price2=@$_POST['price2'];
	$order=@$_POST['order'];
	if($way=='price')//按价格区间查询
		$result=mysql_query("select * from book 
							where $way between $price1 and $price2 
							order by $order");
	else if($way=='publish_year')//按出版年份查询
		$result=mysql_query("select * from book 
							where $way = $info 
							order by $order");
	else if($way=='book_id')//按书号查询
		$result=mysql_query("select * from book 
							where $way = '$info'
							order by $order");
	else//按其他方式查询
		$result=mysql_query("select * from book
							where $way like '%$info%'
							order by $order");
	include("head.php");
	if($result)
	{
		$num=0;
		$number=mysql_num_fields($result);//返回所有字段结构的数组
		echo "<table border=0 bordercolor='navy' class='table table-hover' align=center>";
		echo "<tr class='info'>";
		echo "<td align=center>书号</td>";
		echo "<td align=center>类别</td>";
		echo "<td align=center>书名</td>";
		echo "<td align=center>出版社</td>";
		echo "<td align=center>出版时间</td>";
		echo "<td align=center>作者</td>";
		echo "<td align=center>价格</td>";
		echo "<td align=center>总量</td>";
		echo "<td align=center>库存</td>";
		echo "</tr>";
		while(($row=mysql_fetch_array($result))&&($num<50))
		//返回根据从$result中取得的行生成的数组，并保证显示前50条查询结果
		{	
			$num++;
			echo "<tr>";
			for($i=0;$i<$number;$i++){
			echo "<td align=center>";
			echo " ".$row[$i];
			echo "<br>";
			echo "</td>";
			}
			echo "</tr>";
		}
	}
	mysql_close($link); //关闭数据库
?>
</table>
<div class="alert alert-info">
<A HREF="select_input.php">
<center><b>返回上一页<b><center>
</A>
</div>
<?php
	include("foot.php");
	}
?>
	</center>
</body>
</html>
