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
	else if(@$_SESSION['log']==1)
	{
		include("head.php");
		$link = mysql_connect('localhost','root','102030'); 
		if (!$link) { 
			die('Could not connect to MySQL:' . mysql_error()); 
		} 
		mysql_select_db('hzb', $link);
		$card_id=@$_POST['card_id'];
		$book_id=@$_POST['book_id'];
		$admin=@$_SESSION['ID'];
		mysql_query("set names utf8",$link);
		if($card_id)
		{
			$result=mysql_query("select * from card
								where card_id='$card_id'");
			//在card表中查找卡号是否已经存在
			if(!$row=mysql_fetch_array($result))
			{
				echo "<div class='alert alert-danger'><center><b>卡号不存在</b></center></div>";
?>
<br><center><A HREF="borrow_input.php">更改卡号</center></A>
<?php
			}
			else
			{
				$result=mysql_query("select book_id, type,book_name,company,
									publish_year,auther,price,total_amount,stock_amount 
									from book natural join card natural join record
									where card_id='$card_id'");
				//自然连接三个表，输出读者的借阅信息
				$number=mysql_num_fields($result);
				if($result)
				{
					if($row=mysql_fetch_array($result))
					{
						echo "<center><b>该读者已借出书籍如表格所示：</b></center>";
						echo "<table border=0 bordercolor=#7f7f7f  class='table table-hover' align=center>";
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
						echo "<tr>";
						for($i=0;$i<$number;$i++){
						echo "<td align=center>";
						echo " ".$row[$i];}
						echo "<br>";
						echo "</td>";
						echo "</tr>";
						while($row=mysql_fetch_array($result))
						{
							echo "<tr>";
							for($i=0;$i<$number;$i++){
							echo "<td align=center>";
							echo " ".$row[$i];}
							echo "<br>";
							echo "</td>";
							echo "</tr>";
						}
					}
					else
						echo "<div class='alert alert-danger'><center><b>该读者没有借阅书籍</b></center><br></div>";
				}
			}
		}

?>
	<center>
		<form name="borrow" action="borrow.php" method = "post">
			<table class="table table-hover"><tr><td align=middle>
			<tr><td align=middle>卡号：<input type="text" name="card_id" value=<?php echo $card_id;?> size="20"></td></tr>
			<tr><td align=middle>书号：<input type="text" name="book_id" size="20"></td></tr>
<tr><td align=middle>
<div class="btn-group">
  <button type="submit" class="btn btn-primary">提交</button>
  <button type="reset"  class="btn btn-default">清空</button>
 </div>
 </td></tr>
 			</table>
		</form>
	</center>
<?php
		$result=mysql_query("select book_id, stock_amount from book where book_id=$book_id");
		if($result)
		{
			$row=mysql_fetch_array($result);
			if($row['book_id']&&$row['stock_amount']==0)//图书存在，但库存为零
			{
				echo "<div class='alert alert-danger'><center><b>该书库存为零</center></b></div>";
			/*	$sql=mysql_query("select adddate(curdate(),min(datediff(curdate(),end_date))) 
				from record group by book_id having book_id=$book_id );*/
				$sql=mysql_query("select * from record 
								where end_date > curdate()
								order by end_date asc
								limit 1");//查询最近的归还时间
				if($sql)
				{
					if($row2=mysql_fetch_array($sql))
					{
						echo "<div class='alert alert-info'><center>最近归还日期:</center>";
						echo "<center><b>$row2[3]</b></center></div>";
					}
				}
				else
					echo "<div class='alert alert-danger'><center><b>书籍借出全部过期</center></b></div>";
			}
			else if(!$row['book_id'])//图书不存在
				echo "<div class='alert alert-danger'><center><b>书籍不存在</center></b></div>";
			else if($row['book_id']&&$row['stock_amount'])//图书存在且库存不为零
			{
					$already=mysql_query("select book_id from book
										where $book_id
										in(select book_id
										from card natural join record
										where card_id='$card_id')");//查询表单中的书籍是否在借阅列表中
						if($already)
						{
							$row1=mysql_fetch_array($already);
							if($row1)
							{
								echo "<div class='alert alert-warning'><center><b>该读者已借阅过此书</center></b></div>;";
							}
							else
							{
								mysql_query("update book set 
										stock_amount=stock_amount-1
										where book_id=$book_id");//借阅的书籍库存减一
								mysql_query("insert into record
										(card_id, book_id, begin_date, end_date, admin_id) 
										values ('$card_id', '$book_id', curdate(), curdate()+interval 60 day,'$admin')");
										//在record表中增加借阅信息
								echo "<div class='alert alert-success'><center><b>书籍成功借出</b></center></div></table><br>";
							}
						}
				}
			}		
	mysql_close($link); 
	include("foot.php");
	}
?>
</body>
</html>
