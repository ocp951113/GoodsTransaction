<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<script type="text/javascript" src="../js/jquery-3.1.1.js" ></script>
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="stylesheet" href="../css/user.css" />
		<script src="../js/vue.js"></script>
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
					<a href="userinfo.php" class="username" style="text-decoration: none;"><?php echo $_SESSION['userName']; ?></a>
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
							<a href="want.php" class="" style="text-decoration: none;"><span></span>我想要的</a>
						</li>
						<li>
							<a href="words.php" class="active" style="text-decoration: none;"><span></span>我的留言</a>
						</li>
						<li>
							<a href="userinfo.php" class="" style="text-decoration: none;"><span></span>个人信息</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="message_main">
				<input type="text" id="userId" style="display: none;" value="<?php echo $_SESSION['userId']; ?>"/>
				<div class="" >
					<ul class="message_title">
						<!--<li class="fl left"><div class="leftdiv ">收到的留言</div></li>-->
						<li class="fl right"><div class="rightdiv myactive">发布的留言</div></li>
					</ul>
					<div class="tab-content">
						<div class="tab-item">
							<ul class="comment-list">
								<li class="comment" v-for="(item,index) in words">
									<span style="font-weight: bold;font-size: 16px;">{{item.userName}}</span> 评论: &nbsp;&nbsp;商品 &nbsp;&nbsp;<a :href="'detail.php?productId='+item.productId" target="_blank" style="text-decoration: none; "><span style="color: rgb(17,205,110);">{{item.productName}} </span></a><span class="fr" style="margin-right: 20px;">留言时间：{{item.wordsDate}}</span>
									<p style="margin: 10px 0;">{{item.content}}</p>
								</li>
							</ul>
						</div>
					</div>
				</div> 
			</div>
		</div>
		<script type="text/javascript" src="../js/wordsVue.js" ></script>
	</body>
</html>