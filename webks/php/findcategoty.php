<?php
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');	
	
	$sortType = $_POST['sortType'];
	$sql = "SELECT * FROM product ORDER BY price {$sortType}";
	
	$result = $db->query($sql);
	
	$mydata = array();
	
	while($line = $result->fetch_assoc()){
		$mydata[] = $line;
	}
	echo json_encode($mydata);
?>