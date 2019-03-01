<?php
	$productId = $_POST['myproductId'];
	
	if(isset($_POST['price'])){
		$userId = $_POST['userId'];
		$price = $_POST['price'];
	}
	
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');	
	
	$productIds = implode(",",$productId);
	
	$deleteSQL = "delete from shoppingCart where productId in (".$productIds.")";
	
	$result = $db->query($deleteSQL);
	if(!$result){
		die('数据库返回失败');
	}
	if($result){
		$sql = "update user set userPrice = $price where userId = $userId";
		$result = $db->query($sql);
	}
	if($db->affected_rows == 0){
		echo 'sql 执行成功，但没有删除数据';
	}else{
		echo '成功删除';
	}
	
?>