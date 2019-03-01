<?php
	$productId = $_GET['productId'];
	$sql = "delete from collection where productId = $productId";
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');
	
	$result = $db->query($sql);
	if($result){
		echo "删除成功！";
		header("Location:../html/want.php");
	}else{
		echo "删除失败！";
	}
?>