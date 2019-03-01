<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script type="text/javascript" src="../js/jquery-3.1.1.js" ></script>
		<link rel="stylesheet" href="../css/detail.css" />
		<script type="text/javascript" src="../js/vue.js" ></script>
		<link rel="stylesheet" href="../css/home.css" charset="UTF-8" />
		<script type="text/javascript" src="../js/MagnifierF.js" ></script>
		<script type="text/javascript" src="../js/detail.js" ></script>
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
			if(isset($_GET['productId'])){
				$productId = $_GET['productId'];				
			}
			$db = @new mysqli('127.0.0.1','root', '123456');
		    if ($db->connect_error)	
		      die('链接错误: '. $db->connect_error);
		    $db->query('SET webershou "utf-8"');//UTF8
			$db->select_db('webershou') or die('不能连接数据库');
			
			$sql = sprintf('select * from product where productId = %d',$productId);
			$sqlPic = sprintf('select * from productpic where productId = %d',$productId);
			$resultPic = $db->query($sqlPic);
			$result = $db->query($sql);
			$line = $result->fetch_assoc();
			if($line){
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
		<div id="main" class="clearfix">
			<div class="detail fl clearfix">
				<div class="title">
					<!-- <h2>商品标题商品标题</h2> -->
					<span class="publish-time fl">发布于：<?php echo $line['publishDate']; ?></span>
					<span class="view-number fl">22次浏览</span>

					<span class="view-number fl">1人想要</span>

					<a href="" class="report fr" style="text-decoration: none">举报</a>
				</div>
				<div id="MagnifierWrap2" class="fl">
					<div class="MagnifierMain">
						<img class="MagTargetImg" src="<?php echo '../upload/pic/product/'.$line['typeId'].'/'.$line['pic'] ?>">
					</div>
					<span class="spe_leftBtn">&lt;</span>
					<span class="spe_rightBtn">&gt;</span>
					<div class="spec-items">
						
						<ul>
							<?php while($row = $resultPic->fetch_assoc()){
						 	?>
							<li><img src="<?php echo '../upload/pic/product/'.$line['typeId'].'/'.$row['picSrc'] ?>"></li>
							<?php }?>
						</ul>
						
					</div>
				</div>
				<div class="good-info fr">
					<h2><?php echo $line['productName'] ?></h2>
					<div class="info-line">
						<span class="param-name">价格</span>
						<span class="param-value good-price">￥<?php echo $line['price'] ?></span>
					</div>
					<div class="info-line">
						<span class="param-name">原价</span>
						<span class="param-value good-old-price">￥<?php echo $line['preprice'] ?></span>

						<span class="param-value good-old-link"><a href="<?php $line['buyLink'] ?>" target="_blank">原商品购买链接</a></span>

					</div>

					<div class="info-line">
						<span class="param-name">交易地址</span>
						<span class="param-value address"><?php echo $line['address'] ?></span>
					</div>

					<div class="info-line">
						<span class="param-name">卖家</span>
						<span class="param-value"><?php echo '用户'.$line['userId'] ?></span>
					</div>

					<div class="info-line">
						<span class="param-name">交易方式</span>
						<span class="param-value"><?php echo $line['trackWay']; ?></span>
					</div>
					<?php if($line['phone'] != null && $line['phone'] != ''){ ?>
						<div class="info-line">
							<span class="param-name">手机号</span>
							<span class="param-value"><?php echo $line['phone']; ?></span>
						</div>
					<?php } ?>
						<?php if($line['qq'] != null && $line['qq'] != ''){ ?>
						<div class="info-line">
							<span class="param-name">qq</span>
							<span class="param-value"><?php echo $line['qq']; ?></span>
						</div>
					<?php } ?>
						<?php if($line['weChat'] != null && $line['weChat'] != ''){ ?>
						<div class="info-line">
							<span class="param-name">微信</span>
							<span class="param-value"><?php echo $line['weChat']; ?></span>
						</div>
					<?php } ?>
					<div class="info-line btns">
						<button @click="collection()" class="info-btn want" style="text-decoration: none">想要</button>
						<button @click="addShoppingCart()" id="addShoppingCart" class="info-btn contect-seller" style="text-decoration: none;">加入购物车</button>
					</div>
				</div>
				<div class="good-description">
					<div class="description-title"><span>二货描述</span></div>
					<div class="description-body">
						<p><?php echo $line['productDescribe']; }else{}?></p>
					</div>
				</div>
				<div class="good-description">
					<input type="text" id="productId" style="display: none;" value="<?php echo $productId ?>"/>
					<input type="text" id="userId" style="display: none;" value="<?php echo $_SESSION['userId']; ?>"/>
					<input type="text" id="otheruserId" style="display: none;" value="<?php echo $line['userId'] ?>"/>
					<div class="description-title"><span>二货留言</span></div>
					<div class="description-body">
						<div class="comment-list">
							<ul>
								<li v-for="(item,index) in words">
									<p>留言时间：{{item.wordsDate}}</p>
									<span>{{item.userName}}:  </span>{{item.content}}									
								</li>
							</ul>
						</div>
						<?php if(isset($_SESSION['userId'])){ ?>
							<textarea name="comment" required lay-verify="required" @focus="updatezishu()" v-model="content" placeholder="请输入留言内容" class="comments"></textarea>
						<?php }else{ ?>
							<textarea name="comment" id="content" required lay-verify="required" v-model="content" placeholder="请输入留言内容" class="comments" 
								disabled="disabled"></textarea>
						<?php } ?>
						<div class="comment-btns">
							<button class="comment-submit" @click="publishWords()" style="display:<?php if(isset($_SESSION['userId'])){echo "block";}else{ echo "none"; } ?> ;" >提交</button>
							<span class="comments-words"><span id="zishu">{{zishu}}</span>/100</span>
						</div>
					</div>
				</div>
			</div>
			<div class="detail-sidebar fr">
				<div class="sidebar-header">推荐二货</div>
				<ul class="sidebar-list">
					<li>
						<a href="/detail/101" class="sidebar clearfix">
							<img class="sidebar-image fl" src="http://res.new.taoertao.com/upload/goods/20176/upload_a049cd29d04aef5c8a9af417281bb937.jpg?imageView2/1/w/200/h/200/q/100" alt="洗衣机">
							<p class="sidebar-title">洗衣机</p>
							<p class="sidebar-price">￥500</p>
						</a>
					</li>

					<li>
						<a href="/detail/717" class="sidebar clearfix">
							<img class="sidebar-image fl" src="http://res.new.taoertao.com/upload/goods/20183/upload_68d9ba7bde87f53588f3957ef8b1cc5f.jpg?imageView2/1/w/200/h/200/q/100" alt="销售文化衫广告衫马夹T恤">
							<p class="sidebar-title">销售文化衫广告衫马夹T恤</p>
							<p class="sidebar-price">￥16</p>
						</a>
					</li>

					<li>
						<a href="/detail/116" class="sidebar clearfix">
							<img class="sidebar-image fl" src="http://res.new.taoertao.com/upload/goods/20177/upload_f6b3576268f01459bcac604af9989f8f.png?imageView2/1/w/200/h/200/q/100" alt="三星NX3300微单相机">
							<p class="sidebar-title">三星NX3300微单相机</p>
							<p class="sidebar-price">￥1500</p>
						</a>
					</li>

					<li>
						<a href="/detail/163" class="sidebar clearfix">
							<img class="sidebar-image fl" src="http://res.new.taoertao.com/upload/goods/20177/upload_bfec93a9aeabecb7e7f2c3e63b340c0e.jpg?imageView2/1/w/200/h/200/q/100" alt="refa经典铂金双轮美容仪">
							<p class="sidebar-title">refa经典铂金双轮美容仪</p>
							<p class="sidebar-price">￥1000</p>
						</a>
					</li>

					<li>
						<a href="/detail/319" class="sidebar clearfix">
							<img class="sidebar-image fl" src="http://res.new.taoertao.com/upload/goods/20178/upload_001a9e3ce4b5da6812253d0c36de56be.jpg?imageView2/1/w/200/h/200/q/100" alt="交换机全新60元转让。">
							<p class="sidebar-title">交换机全新60元转让。</p>
							<p class="sidebar-price">￥60</p>
						</a>
					</li>

				</ul>
			</div>
		</div>
		
		<script type="text/javascript" src="../js/detailVue.js" ></script>
	</body>
</html>