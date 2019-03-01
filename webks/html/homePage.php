<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/vue.js"></script>
		<link rel="stylesheet" href="../css/home2.css" charset="UTF-8" />
		<link rel="stylesheet" href="../css/home.css" charset="UTF-8" />
	</head>

	<body id="contain">
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
			<div class="category fl">
				<ul>
					<li>
						<a href="category_list.php?typeId=1">手机<i><span class="glyphicon glyphicon-chevron-right" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=2">电脑<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=3">配件<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=4">电器<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=5">书籍<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=6">娱乐<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=7">运动<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>

					<li>
						<a href="category_list.php?typeId=8">代步<i><span class="glyphicon glyphicon-chevron-right arrowRight" style="color: #11cd6e;"></span></i></a>
					</li>
				</ul>
			</div>
			<div class="main-box fl">
				<div class="banner">
					<div class="focusMap fl">
						<span class="prev glyphicon glyphicon-chevron-left text-center"></span>
						<span class="next glyphicon glyphicon-chevron-right text-center"></span>
						<ul class="rImg">
							<li>
								<a href="#"><img src="https://img.alicdn.com/tfs/TB1pS8_xKSSBuNjy0FlXXbBpVXa-520-280.png_q90_.webp" /></a>
							</li>
							<li>
								<a href="#"><img src="https://img.alicdn.com/simba/img/TB1EgSfzhSYBuNjSsphSuvGvVXa.jpg" /></a>
							</li>
							<li>
								<a href="#"><img src="https://img.alicdn.com/simba/img/TB1W26Wth1YBuNjy1zcSuvNcXXa.jpg" /></a>
							</li>
							<li>
								<a href="#"><img src="https://img.alicdn.com/simba/img/TB11t1ZzeuSBuNjy1XcSuwYjFXa.jpg" /></a>
							</li>
							<li>
								<a href="#"><img src="https://img.alicdn.com/tfs/TB1pS8_xKSSBuNjy0FlXXbBpVXa-520-280.png_q90_.webp" /></a>
							</li>
						</ul>
						<ul class="button">
							<li class="on"></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</div>
				</div>
				<div class="index-list">
					<div class="list-header">
						<a href="">&nbsp;</a>
						<a class="fl">
							<div style="width: 100px;">
								<div class="fl" style="margin-right: 8px;">按价格排序</div>
								<div class="triangle-down fl" @click="sortASC()"></div>
								<div class="triangle-up fl" @click="sortDESC()"></div>
							</div>
						</a>
						<a href="myPublish.php" class="fr">发布信息</a>
					</div>
				</div>
				<div class="list-body">
					<ul class="clearfix">
						<li v-for="(item,index) in products">
							<a :href="'detail.php?productId='+item.productId" target="_blank" class="good-image">
								<img class="image-real-box" :src="'../upload/pic/product/'+item.typeId+'/'+item.pic" >
							</a>
							<a href="" target="_blank" class="good-title">小天鹅大瀑布全自动洗衣机</a>
							<span class="good-price" style="font-size: 13px;">￥{{item.price}}</span>
							<span class="pub-time fr">发布于{{item.publishDate}}</span>
						</li>
					</ul>
				</div>
				<div id="page" class="page">
					<div class="pre"><button class="btn btn-primary" @click="getProducts(page-=1)">上一页</button></div>
					<div class="cur"><input id="currentPage" class="currentPage" v-model="page">页</div>
					<div class="after"><button class="btn btn-primary" @click="getProducts(page+=1)">下一页</button></div>
				</div>
			</div>
			<div class="sidebar fr">
				<div class="sidebar-banner-right">
					<div class="wei clearfix">
						<div class="wei-left fl">
							<a href="" class="weixin"><img src="../img/weixin.png"></a>
							<a href="" target="_blank" class="weibo"><img src="../img/weibo.png"></a>
						</div>
						<div class="wei-right fr">
							<img src="" alt="">
							<span class="triangle"></span>
						</div>
					</div>
					<div class="app-download">
						<p>手机 APP 下载</p>
						<a href="">Download</a>
					</div>
				</div>
				<div class="sidebar-main-right">
					<a class="sidebar-header" href="/quan" target="_blank">优惠券</a>
					<ul class="jizhuan-list">
						<li>
							<a href="https://s.click.taobao.com/t?e=m%3D2%26s%3DpynztcKsTp8cQipKwQzePOeEDrYVVa64XoO8tOebS%2Bfjf2vlNIV67nH9ck9kfhBEhEvvQe3dPn1CsNV6GWz%2B8VUx8%2BFSzoEaJOkIs%2FRKhrcXp9GJasdwUHEumm%2B6nHzyiM9nxYkhT7uZSW8QS28nh%2BBIIrxx6gpRlw6LmJeOera1jVR%2BYBlNrgkXo9nS0hctOJjEmYPM%2BP5N3DgsBvsBBz3uadHDXLD9IYULNg46oBA%3D" class="jizhuan" target="_blank">
								<img class="jizhuan-image" src="https://img.alicdn.com/tfscom/i3/2068928493/TB2h2XDegOI.eBjSszhXXbHvFXa_!!2068928493.jpg" alt="Asus/华硕 静音有线鼠标 USB光电鼠标 笔记本台式通用鼠标 包邮">
								<p class="jizhuan-title">Asus/华硕 静音有线鼠标 USB光电鼠标 笔记本台式通用鼠标 包邮</p>
								<p>
									<span class="yhq">￥18.80</span>
									<span class="jizhuan-price">￥29.00</span>
								</p>
							</a>
						</li>
						<li>
							<a href="https://s.click.taobao.com/t?e=m%3D2%26s%3DpynztcKsTp8cQipKwQzePOeEDrYVVa64XoO8tOebS%2Bfjf2vlNIV67nH9ck9kfhBEhEvvQe3dPn1CsNV6GWz%2B8VUx8%2BFSzoEaJOkIs%2FRKhrcXp9GJasdwUHEumm%2B6nHzyiM9nxYkhT7uZSW8QS28nh%2BBIIrxx6gpRlw6LmJeOera1jVR%2BYBlNrgkXo9nS0hctOJjEmYPM%2BP5N3DgsBvsBBz3uadHDXLD9IYULNg46oBA%3D" class="jizhuan" target="_blank">
								<img class="jizhuan-image" src="https://img.alicdn.com/tfscom/i3/2068928493/TB2h2XDegOI.eBjSszhXXbHvFXa_!!2068928493.jpg" alt="Asus/华硕 静音有线鼠标 USB光电鼠标 笔记本台式通用鼠标 包邮">
								<p class="jizhuan-title">Asus/华硕 静音有线鼠标 USB光电鼠标 笔记本台式通用鼠标 包邮</p>
								<p>
									<span class="yhq">￥18.80</span>
									<span class="jizhuan-price">￥29.00</span>
								</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div style="height: 1100px; float: right;">
			</div>
		</div>

		<!--<div id="footer">
			<div class="go-to-top">
				<a href="#" title="回顶部" class="icon">&#xe61c;</a>
			</div>
			<div class="footer-bottom-wrap">
				<div class="footer-bottom">
					<p class="friend-link">
						<span>友情链接：</span>

						<a href="http://www.taoertao.com" target="_blank">校园二手街</a>

						<a href="http://s.click.taobao.com/t?e=m%3D2%26s%3DSVOy%2B2S83qUcQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClApbI%2FwEgUFo57A0NQVfhIWnWlYAfygmyzwmMPCaw1n1BezW1ZIWTWhBNnYJkv%2BovXudn1BbglxZYxUhy8exlzcq9AmARIwX9K%2B" target="_blank">阿里云</a>

						<a href="https://m.do.co/c/5d3683a687a6" target="_blank">新手服务器推荐</a>

						<a href="https://portal.qiniu.com/signup?code=3latfmv9iksb6" target="_blank">七牛云</a>

						<a href="http://www.taoertao.com" target="_blank">大学生二手网</a>

						<a href="#" target="_blank">最新淘宝优惠券</a>

						<a href="http://www.wanlinqiang.com/about" target="_blank">承接网站开发</a>

					</p>
					<p class="column">
						<a href="#">关于我们</a>
						<a href="#">常见问题</a>
						<a href="#">意见反馈</a>
						<a href="#">服务协议</a>
						<a href="#">联系我们</a>
					</p>
					<p class="tips">本站所有信息均为用户自由发布，本站不对信息的真实性负任何责任，交易时请注意识别信息的真假如有网站内容侵害了您的权益请联系我们删除，举报QQ：584845663</p>
					<p class="right">
						<span>Copyright © 2018-2018, zhku.cn</span>
						<a target="_blank" href="http://www.miitbeian.gov.cn/">zhku</a>
						<a class="beian" target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33011802000633" style="display:inline-block;height:20px;line-height:20px;">钟落潭镇广新路388号仲恺农业工程学院</a>
						<span>邮箱：584845663@qq.com</span>
						<a href="http://webscan.360.cn/index/checkwebsite/url/new.taoertao.com" target="_blank"><img border="0" src="http://webscan.360.cn/img/logo_verify.png" /></a>
					</p>
				</div>
			</div>
		</div>-->
		<script src="../js/homePage.js"></script>
		<script type="text/javascript" src="../js/homeVue.js" ></script>
	</body>

</html>