<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="stylesheet" href="../css/reset.css">
    	<link rel="stylesheet" href="../css/carts.css">
    	<script type="text/javascript">
			function f(){
				var keywords = $("#keywords").val();
				window.location.href = "category_list.php?keywords="+keywords;
			}
		</script>
	</head>
	<body>
		<?php 
			session_start(); 
			$db = @new mysqli('127.0.0.1','root', '123456');
		    if ($db->connect_error)	
		      die('链接错误: '. $db->connect_error);
		    $db->query('SET webershou "utf-8"');//UTF8
			$db->select_db('webershou') or die('不能连接数据库');	
			
			if(isset($_SESSION['userId'])){
				$userId = $_SESSION['userId'];
				
				$sql = "select * from user where userId = $userId";
				$result2 = $db->query($sql);
				$user = $result2->fetch_assoc();
				$price = $user['userPrice'];
				
				
				$sql = "select * from shoppingcart where userId = $userId";
				$result1 = $db->query($sql);
				if($result1){
					$productId = array();
					while($line = $result1->fetch_assoc()){
						$productId[] = $line['productId'];
					}
					$productIds = implode(",", $productId);
					$sql = "select * from product where productId in (".$productIds.")";
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
						<input id="keywords" type="text" class="keywords" placeholder="请输入关键词">
						<a href="javascript:;" onclick="f()" id="search" class="search-btn search-normal-btn">搜索</a>
					</div>
				</div>
				<div class="publish fr">
					<a href="myPublish.php" class="publish-btn" style="text-decoration: none;"><span class="glyphicon glyphicon-pencil" style="color: #fff;"></span>发布二货</a>
				</div>
			</div>
		</div>
			<section class="cartMain">
	        <div class="cartMain_hd">
	            <ul class="order_lists cartTop">
	                <li class="list_chk">
	                    <!--所有商品全选-->
	                    <input type="checkbox" id="all" class="whole_check">
	                    <label for="all"></label>
	                    全选
	                </li>
	                <li class="list_con">商品信息</li>
	                <li class="list_info">商品参数</li>
	                <li class="list_price">单价</li>
	                <li class="list_amount">数量</li>
	                <li class="list_sum">金额</li>
	                <li class="list_op">操作</li>
	            </ul>
	        </div>
	
	        <div class="cartBox">
			<form id="myform" name="myform">
					<input type="text" name="userId" style="display: none;" value="<?php echo $userId; ?>"/>
		            <div class="order_content">
		            	<?php
		            		if($result){
			            		$i = 0;
			            		while($line = $result->fetch_assoc()){	
			            			$i++;
		            	?>
		            	
		                <ul class="order_lists">
		                    <li class="list_chk">
		                        <input type="checkbox" name="myproductId[]" value="<?php echo $line['productId'] ?>" id="checkbox_<?php echo $i; ?>" class="son_check">
		                        <label for="checkbox_<?php echo $i; ?>"></label>
		                    </li>
		                    <li class="list_con">
		                        <div class="list_img"><a href="detail.php?productId=<?php echo $line['productId']; ?>"><img src="../upload/pic/product/<?php echo $line['typeId']."/".$line['pic']; ?>" alt=""></a></div>
		                        <div class="list_text"><a href="detail.php?productId=<?php echo $line['productId']; ?>"><?php echo $line['productName']; ?></a></div>
		                    </li>
		                    <li class="list_info">
		                        <p>规格：默认</p>
		                        <p>尺寸：16*16*3(cm)</p>
		                    </li>
		                    <li class="list_price">
		                        <p class="price">￥<?php echo $line['price']; ?></p>
		                    </li>
		                    <li class="list_amount">
		                        <div class="amount_box">
		                            <a href="javascript:;" class="reduce reSty">-</a>
		                            <input type="text" value="1" class="sum">
		                            <a href="javascript:;" class="plus">+</a>
		                        </div>
		                    </li>
		                    <li class="list_sum">
		                        <p class="sum_price">￥<?php echo $line['price']; ?></p>
		                    </li>
		                    <li class="list_op">
		                        <p class="del">
		                        	<a href="javascript:;" class="delBtn">移除商品</a>
		                        	<input type="text" style="display: none;" value="<?php echo $line['productId']; ?>"/>
		                        </p>
		                    </li>
		                </ul>
		                <?php 
		                	}}}
		                ?>
		            </div>
	            </form>
	        </div>
	
	       
	        <!--底部-->
	        <div class="bar-wrapper">
	            <div class="bar-right">
	            	<div class="piece">余额<strong><?php echo $price; ?></strong>元</div>
	            	<input type="text" style="display: none;" value="<?php echo $price; ?>" id="myprice" />
	                <div class="piece">已选商品<strong class="piece_num">0</strong>件</div>
	                <div class="totalMoney">共计: <strong class="total_text">0.00</strong></div>
	                <div class="calBtn"><a href="javascript:;" id="jiesuan">结算</a></div>
	            </div>
	        </div>
	    </section>
   
    <section class="model_bg"></section>
    <section class="my_model">
        <p class="title">删除宝贝<span class="closeModel">X</span></p>
        <p>您确认要删除该宝贝吗？</p>
        <div class="opBtn"><a href="javascript:;" class="dialog-sure">确定</a><a href="" class="dialog-close">关闭</a></div>
    </section>
	
    <script src="../js/jquery-3.1.1.js"></script>
    <script src="../js/carts.js"></script>
		
	</body>
</html>
