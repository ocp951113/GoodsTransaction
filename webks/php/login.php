<?php
	session_start();
	
	if(isset($_POST['userId'])){
		$userId = $_POST['userId'];
	}
	if(isset($_POST['password'])){
		$psw = $_POST['password']; 
	}
	
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');
	
	$sql = "select * from user where userId=".$userId;
	$result = $db->query($sql);
	
	if($result){
		$line = $result->fetch_assoc();
		if($line['password'] == $psw){
			$_SESSION['userId'] = $userId;
			$_SESSION['password'] = $psw;
			$_SESSION['userName'] = $line['userName'];
			$_SESSION['userPicSrc'] = $line['userPicSrc'];
			$_SESSION['user'] = $line;
			echo "success";
		}else{
			echo "fail";
		}
	}
	
?>