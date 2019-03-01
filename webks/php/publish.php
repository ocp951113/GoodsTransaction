<?php
	session_start();
	
	$type = $_POST['type'];
	$productName = $_POST['productName'];
	$productDescribe = $_POST['productDescribe'];
	$price = $_POST['price'];
	$preprice = $_POST['preprice'];
	$buyLink = $_POST['buyLink'];
	$trackWay = $_POST['rad'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$qq = $_POST['qq'];
	$wechat = $_POST['wechat'];
	
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');
	
	$productPic = "";
	foreach($_FILES['pics']['tmp_name'] as $k=>$v){
		$productPic = $_FILES['pics']['name'][$k];
	}
	
	
	$userId = $_SESSION['userId'];
	
	$odate=date("Y-m-d H:i:s");
	
	$sql = "insert into product(productName,price,preprice,productDescribe,typeId,pic,userId,
			publishDate,address,trackWay,buyLink,weChat,qq,phone) values ('".$productName."',".
			$price.",".$preprice.",'".$productDescribe."',".$type.",'".$productPic."','".$userId.
			"','".$odate."','".$address."','".$trackWay."','".$buyLink."','".$wechat.
			"','".$qq."','".$phone."')";
//			echo $sql;
	$result = $db->query($sql);	
	if($result){
		$productId = mysqli_insert_id($db); 
		foreach($_FILES['pics']['tmp_name'] as $k=>$v){
			if(is_uploaded_file($_FILES['pics']['tmp_name'][$k])){
				$save='../upload/pic/product/'.$type.'/'.$_FILES['pics']['name'][$k];
				$sql = "insert into productpic (productId,picSrc) values({$productId},'{$_FILES['pics']['name'][$k]}')";
				$result = $db->query($sql);
				if($result){
					move_uploaded_file($_FILES['pics']['tmp_name'][$k],$save);
//					echo "插入成功!";
				}
			}
		}
		header("Location:../html/userPublish.php");
	}else{
		echo "插入失败！";
	}
?>