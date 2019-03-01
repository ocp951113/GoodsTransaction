<?php
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');
	
	$querySql = "select * from product";
	
	$page = 1;
	$record = 6;
	if (isset($_POST['page']) === true){
    	$pages = $_POST['page'];
    	if($pages>0){
    		$page = $pages;
    	}else{
    		$page = 1;
    	}
    }
	
	$nStart = ($page - 1) * $record;
	
	$limit = sprintf('select * from product order by productId limit %d,%d',$nStart,$record);
	
	$result = $db->query($limit);
	
	$mydata = array();
	
	while($line = $result->fetch_assoc()){
		$mydata[] = $line;
	}
	echo json_encode($mydata);
	
	
?>