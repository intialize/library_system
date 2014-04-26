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
	$file=@$_FILE['book_in'];
	mysql_query("set names utf-8",$link);
	mysql_query("set character set 'utf8'",$link);//读库
	if ((@$_FILES["file"]["type"] == "text/plain")  
		&& (@$_FILES["file"]["size"] < 20000))  
		  {  
			  if (@$_FILES["file"]["error"] > 0)  
			  {  
				  echo "<center>"."<div class='alert alert-danger'><b>上传出错:</b></div> " .
					  @$_FILES["file"]["error"] . "<br></center>";
			  }  
			  else  
			  {  
				  echo  "<center>".
					  "<b><div class='alert alert-success'>成功上传文件</b>: " . @$_FILES["file"]["name"] .
					  "</div></center>";  
				  if (file_exists("c:\wamp\www\upload\stock_in_" . @$_FILES["file"]["name"]))  
				  {  
					  echo  "<center><div class='alert alert-info'>". @$_FILES["file"]["name"] .
						  "<b>该文件已经存在</div></b>"."</center>"; 
				  }  
				  else  
				  {  
					  move_uploaded_file(@$_FILES["file"]["tmp_name"],  
						  "c:\wamp\www\upload\stock_in_" . @$_FILES["file"]["name"]);
					  echo "<center><div class='alert alert-info'>"."<b>文件存储位置：</b>" . 
						  "C:\wamp\www\upload\stock_in_" 
						  . @$_FILES["file"]["name"]."</div></center>";							
				  }  
			  }  
	$f='c:\wamp\www\upload\stock_in_'.@$_FILES["file"]["name"];
	$file_in = fopen($f,'r') or die('读取文件失败');
	 while(!feof($file_in)){ //循环读取文件
		   $row = fgets($file_in); //从文件中读取一行（默认1024字节或碰到转行符）
		   $row = explode(',',$row);//以,为标志将一行打散成数组
		   mysql_query("set names utf-8",$link);
		   $sql=mysql_query("select * from `book`
							where `book_id`='$row[0]' and `book_name`='$row[2]'");
		   if($sql)
			   $result=mysql_fetch_array($sql);
		   if($result){
			   echo "<br><center>".$row[0].$row[2]."已在库中，已更新数量"."</center>";
			   mysql_query("set names utf-8",$link);
			   mysql_query("update `book` 
							set `total_amount`=`total_amount`+$row[7],
							`stock_amount`=`stock_amount`+$row[7]
			   where book_id='$row[0]' and book_name='$row[2]'");	
 			}
			else
		   {
			   mysql_query("set names utf-8",$link);
			   $sql="insert into `book`(`book_id`, `type`, `book_name`, `company`,
					   `publish_year`,  `auther`, `price`, `total_amount`, `stock_amount`)
					   values ('$row[0]','$row[1]','$row[2]','$row[3]',
						   $row[4],'$row[5]',$row[6],$row[7],$row[7])"; 
			   mysql_query($sql);
		   }
		 }
	fclose($file_in);
		  }
	else  
	{  
		echo "<center>"."<div class='alert alert-danger'><b>无效文件</b></div>"."</center>";  
	}
		  	  mysql_close($link);
?>
	<div class="alert alert-default">
	<A HREF="stock_input.php">
	<center><b>返回上一页</b></center>
	</A>
	</div>
</table>
<?php
		include("foot.php");
	}
?>
</body>
</html>
