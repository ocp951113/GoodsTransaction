<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="stylesheet" href="../css/user.css" />
	</head>

	<body>
		<?php
			session_start(); 
			$db = @new mysqli('127.0.0.1','root', '123456');
		    if ($db->connect_error)	
		      die('链接错误: '. $db->connect_error);
		    $db->query('SET webershou "utf-8"');//UTF8
			$db->select_db('webershou') or die('不能连接数据库');	
		?>
		<div id="header">
			<div class="header-wrap">
				<a href="homePage.php" class="logo fl">
					<img src="../img/new-logo.png" />
				</a>
				<ul class="nav fl">
					<li>
						<a href="homePage.php">首页</a>
					</li>
					<li>
						<a href="">优惠券</a>
					</li>
					<li>
						<a href="http://www.taobao.com">爱淘宝</a>
					</li>
				</ul>
				<div class="nav-right fr">
					<?php 
						if(isset($_SESSION['userName'])){
					?>
						<a href="shoppingCar.php" class="log-btn">购物车</a>
							
						<a href="userinfo.php" class="log-btn"> <img
								src="../upload/pic/user/<?php echo $_SESSION['userPicSrc']; ?>"
								class="user-header-image"><?php echo $_SESSION['userName']; ?></a>
						<a href="../php/exit.php" class="log-btn">退出</a>
					<?php }else{ ?>
						<a href="register.html" class="log-btn">注册</a>
						<a href="login.html" class="log-btn">登录</a>
					<?php } ?>

				</div>
			</div>
		</div>
		<div id="main" class="clearfix">
			<div class="user-sider fl">
				<div class="user-info">
					<img src="../upload/pic/user/<?php echo $_SESSION['userPicSrc']; ?>" class="user-header">
					<a href="userinfo.php" class="username"><?php echo $_SESSION['userName']; ?></a>
					<div class="auth">
						<a class="realname-auth" href=""></a>
						<a class="phone-auth" href=""></a>
						<a class="email-auth" href=""></a>
					</div>
				</div>
				<div class="sider-nav">
					<ul>
						<li>
							<a href="userPublish.php" class="" style="text-decoration: none;"><span></span>我发布的</a>
						</li>
						<li>
							<a href="want.php" class="active" style="text-decoration: none;"><span></span>我想要的</a>
						</li>
						<li>
							<a href="words.php" class="" style="text-decoration: none;"><span></span>我的留言</a>
						</li>
						<li>
							<a href="userinfo.php" class="" style="text-decoration: none;"><span></span>个人信息</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="user-main fr">
				<ul>
					<?php
//						'".$_SESSION['userId']."'
						$myarr = array();
						$sql = "select * from collection where userId='".$_SESSION['userId']."'";
						$result = $db->query($sql);
						while($line = $result->fetch_assoc()){
							$myarr[] = $line['productId'];
						}
						$productIds = implode(",",$myarr);
						
						if($productIds != null){
							$sql = "select * from product where productId in(".$productIds.")";
							$result = $db->query($sql);
							while($line = $result->fetch_assoc()){
							
					?>
					<li>
						<div class="list-header">
							<span>时间：<?php echo $line['publishDate']; ?></span>
						</div>
						<div class="list-main clearfix">
							<a href="detail.php?productId=<?php echo $line['productId']; ?>" class="goods-images fl" target="_blank"><img src="<?php echo '../upload/pic/product/'.$line['typeId'].'/'.$line['pic'] ?>"></a>
							<div class="good-info fl">
								<a href="detail.php?productId=<?php echo $line['productId']; ?>" class="goods-title" target="_blank" style="text-decoration: none;"><?php echo $line['productName']; ?></a>
								<p class="goods-price">￥<span><?php echo $line['price']; ?></span></p>
							</div>
							<div class="operation fr">
								<a href="detail.php?productId=<?php echo $line['productId'] ?>" class="" target="_blank" style="text-decoration: none;">查看详情</a>
								<a href="../php/deleteCollection.php?productId=<?php echo $line['productId']; ?>" class="delete-want" style="text-decoration: none;">移除想要</a>
							</div>
						</div>
					</li>
					<?php }} ?>

				</ul>
				<div id="page"></div>
			</div>
		</div>
	</body>

</html>