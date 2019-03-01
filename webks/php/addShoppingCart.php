<?php
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');	
	
	$userId = $_POST['userId'];
	$productId = $_POST['productId'];
	$sql = "insert into shoppingcart(userId,productId) values ($userId,$productId)";
	$result = $db->query($sql);
	if($result){
		echo "添加成功";
	}else{
		echo "已经在购物车中了";
	}
	
	
?>