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
		include("head.php");
		$link = mysql_connect('localhost','root','102030'); 
		if (!$link) 
			die('Could not connect to MySQL:'.mysql_error()); 
		mysql_select_db('hzb', $link);
		$book_id=@$_POST['book_id'];
		$type=@$_POST['type'];
		$book_name=@$_POST['book_name'];
		$company=@$_POST['company'];
		$publish_year=@$_POST['publish_year'];
		$auther=@$_POST['auther'];
		$price=@$_POST['price'];
		$quantity=@$_POST['quantity'];
		mysql_query("set names utf8",$link);
		$res=mysql_query("select * from book
						where book_id = '$book_id'");
		if($res)
		{
			$haha=mysql_fetch_array($res);
		//$result=mysql_query("select * from book 
		//					where book_id='$book_id'
		//					and book_name='$book_name'");//查询书号是否已经存在
	//	if($result)
	//		$row=mysql_fetch_array($result);
			if($haha)
			{
				$result=mysql_query("select * from book 
								where book_id='$book_id'
								and book_name='$book_name'");//查询书名和书号是否相符
				if($result)
				{
					$row=mysql_fetch_array($result);
				}
				if($row&&$quantity)
				{
					mysql_query("update book set 
								total_amount=total_amount+$quantity,
								stock_amount=stock_amount+$quantity 
								where book_id=$book_id");
					echo "<div class='alert alert-info'><center><b>库中已有此书，数量已更新</b></center></div>";//如果书号已经存在，则更新库存和总量
				}
				else if($row&&!$quantity)
					echo "<div class='alert alert-danger'><center><b>请输入书籍数量以更新</b></center></div>";
				else 
					echo "<div class='alert alert-danger'><center><b>书号已存在，但书名不符合</b></center></div>";
			}
			else
			{	
				if($book_id&&$type&&$book_name&&$company&&$publish_year&&$auther&&$price&&$quantity)
				{
					mysql_query("insert into book(book_id, type,book_name,company,
								publish_year,auther,price,total_amount,stock_amount)
								values ('$book_id','$type', '$book_name', '$company',
								$publish_year,'$auther', $price, $quantity, $quantity)");//如果书号不存在，则插入数据库中
				echo "<div class='alert alert-success'><center><b>新书入库成功</b></center></div>";
				}
			else
				echo "<div class='alert alert-danger'><center><b>书籍信息不全，添加失败</b></center></div>";//书籍信息不全
			}
		}
		mysql_close($link); 
?><div class='alert alert-info'>
	<A HREF="stock_in1.php">
	<center><b>继续添加书籍</b><center>
	</A>
</div>
</table>
<?php
	include("foot.php");
	}
?>
</body>
</html>
