<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
		<link rel="stylesheet" href="../css/home.css" charset="UTF-8" />
		<link rel="stylesheet" href="../css/category_list.css" />
		<script src="../js/vue.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#main .cate-name-list a").click(function(){
					$(this).classname = "active";
				});
			});
			function f(){
				var keywords = $("#keywords").val();
				window.location.href = "category_list.php?keywords="+keywords;
			}
		</script>

	</head>

	<body>
<?php
	$db = @new mysqli('127.0.0.1','root', '123456');
    if ($db->connect_error)	
      die('链接错误: '. $db->connect_error);
    $db->query('SET webershou "utf-8"');//UTF8
	$db->select_db('webershou') or die('不能连接数据库');	
	
	if(isset($_GET['typeId'])){
		$typeId = $_GET['typeId'];
		
		$sql = sprintf('select * from product where typeId=%d',$typeId);
		$result = $db->query($sql);
	}
	if(isset($_GET['keywords'])){
		$keywords = $_GET['keywords'];
		$sql = "select * from product where productName like '%".$keywords.
			"%' or price like '%".$keywords."%' or preprice like '%".$keywords.
			"%' or productDescribe like '%".$keywords."%' or address like '%".$keywords.
			"%' or trackWay like '%".$keywords."%' or 
			typeId in (select typeId from sort where typeName like '%".$keywords."%')";
	
		$result = $db->query($sql);
	}
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
						session_start(); 
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
		<div id="header-bottom">
			<div class="header-bottom-wrap clearfix">
				<div class="search-wrap fl">
					<div class="search">
						<input type="text" id="keywords" class="keywords" placeholder="请输入关键词">
						<a href="javascript:;" onclick="f()" id="search" class="search-btn search-normal-btn">搜索</a>
					</div>
				</div>
				<div class="publish fr">
					<a href="myPublish.php" class="publish-btn" style="text-decoration: none;"><span class="glyphicon glyphicon-pencil" style="color: #fff;"></span>发布二货</a>
				</div>
			</div>
		</div>
		<div id="main" class="clearfix">
			<div class="cate-name-list">
				<a class="" href="category_list.php?typeId=0" style="text-decoration: none;">全部分类</a>

				<a class="" href="category_list.php?typeId=1" style="text-decoration: none;">手机</a>

				<a class="" href="category_list.php?typeId=2" style="text-decoration: none;">电脑</a>

				<a class="" href="category_list.php?typeId=3" style="text-decoration: none;">配件</a>

				<a class="" href="category_list.php?typeId=4" style="text-decoration: none;">电器</a>

				<a class="" href="category_list.php?typeId=5" style="text-decoration: none;">书籍</a>

				<a class="" href="category_list.php?typeId=6" style="text-decoration: none;">娱乐</a>

				<a class="" href="category_list.php?typeId=7" style="text-decoration: none;">运动</a>

				<a class="" href="category_list.php?typeId=8" style="text-decoration: none;">代步</a>

			</div>
			<div class="list-body">
				<ul class="clearfix">
					<?php  while($line = $result->fetch_assoc()){ ?>
						<input type="text" style="display: none;" v-model="mytype"/>
					<li>
						<a href="detail.php?productId=<?php echo $line['productId']; ?>" class="good-image" target="_blank"><img src="<?php echo '../upload/pic/product/'.$line['typeId'].'/'.$line['pic']; ?>"></a>
						<a href="detail.php?productId=<?php echo $line['productId']; ?>" class="good-title" target="_blank"><?php echo $line['productName']; ?></a>
						<span class="good-price">￥<?php echo $line['price']; ?></span>
						<span class="pub-time" style="float: right;">发布于<?php echo $line['publishDate']; ?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<script type="text/javascript" src="../js/category_list.js" ></script>
	</body>

</html>