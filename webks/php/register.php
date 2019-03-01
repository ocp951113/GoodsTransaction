<?php
	session_start();
	
	if(isset($_POST['userId'])){
		$userId = $_POST['userId'];
	}
	if(isset($_POST['pwd'])){
		$psw = $_POST['pwd']; 
	}
	if(isset($_POST['check_pwd'])){
		$check_pwd = $_POST['check_pwd']; 
	}
	if(isset($_POST['name'])){
		$name = $_POST['name']; 
	}
	
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');
	
	$sql = "insert into user (userId,userName,password,userPicSrc) values('$userId','$name','$psw','1f978ec9867f41e782d2c27404fd03af.png')";
	$result = $db->query($sql);
//	echo $sql;
	
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
			header("Location:../html/homePage.php");
		}else{
			echo "fail";
		}
	}
	
?>