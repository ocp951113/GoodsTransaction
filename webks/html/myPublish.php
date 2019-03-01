<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script src="../js/jquery-3.1.1.js"></script>
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/radio.css" />
		<link rel="stylesheet" href="../css/fileinput.min.css" />
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css" />
		<link rel="stylesheet" href="../css/myPublish.css" />
		<script src="../js/prefixfree.min.js"></script>
		<script src="../js/modernizr.js"></script>
		
		<script type="text/javascript">
			$(function(){
				var statu = 0;
				$("#buyLink").hide();
				$("#buyLinkbtn").click(function(){
					statu = !statu;
					if(statu == 0)
						$("#buyLink").hide();
					if(statu == 1)
						$("#buyLink").show();
				});
				$("#rad").click(function(){
					$("#address").hide();
				});
				$("#rad2").click(function(){
					$("#address").show();
				});
				$("#rad3").click(function(){
					$("#address").show();
				});
				
			});
		</script>
	</head>

	<body>
		<div id="header">
			<div class="header-wrap">
				<a href="homePage.php" class="logo fl">
					<img src="../img/new-logo.png" />
				</a>
				<ul class="nav fl">
					<li>
						<a href="homePage.php">首页</a>
					</li>
					<!--<li>
						<a href="">优惠券</a>
					</li>-->
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
		<h3 class="toptips text-info">发布</h3>
		<div id="main" class="clearfix">
			<form action="../php/publish.php" method="post" enctype="multipart/form-data">
				<div class="inputImg row">
					<div class="topspan text-info"><span>请输入商品图片</span></div>
				</div>
				<div class="productImg">
					<input id="Portrait1" type="file" name="pics[]" multiple="multiple" data-preview-file-type="text"/>
				</div>
				<div class="row">
					<div class="leftspan text-info"><span>商品名称</span></div>
					<div class="rightspan">
						<input type="text" class="text" name="productName" placeholder="请输入商品名称" />
						<div class="tips">14个字以内</div>
					</div>
				</div>
				<div class="row">
					<div class="topspan text-info"><span>商品详情</span></div>
					<div class="bottomspan">
						<textarea placeholder="请输入商品详情" name="productDescribe"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="leftspan text-info"><span>价格</span></div>
					<div class="rightspanlittle">
						<input type="text" class="text" name="price" placeholder="请输入价格" />
						<div class="tips">元</div>
					</div>
					<div class="leftspan text-info"><span>原价</span></div>
					<div class="rightspanlittle">
						<input type="text" class="text" name="preprice" placeholder="请输入原价" />
						<div class="tips">元</div>
					</div>
					<div class="originalLink btn btn-info" id="buyLinkbtn"><span class="glyphicon glyphicon-plus-sign"></span>添加源购买链接</div>
				</div>
				<div class="row" id="buyLink">
					<div class="leftspan text-info">
						<span>商品购买原链接</span>
					</div>
					<div class="rightspan" >
						<input type="text" style="width:800px" class="text" name="buyLink" placeholder="请输入商品购买原链接" />
					</div>
				</div>
				<div class="row">
					<div class="leftspan text-info"><span>商品类别</span></div>
					<select id="sort" name="type" class="rightspanlittle">
						<option class="sort btn" value="0">请选择分类</option>
						<option class="sort btn" value="1">手机</option>
						<option class="sort btn" value="2">电脑</option>
						<option class="sort btn" value="3">配件</option>
						<option class="sort btn" value="4">电器</option>
						<option class="sort btn" value="5">书籍</option>
						<option class="sort btn" value="6">娱乐</option>
						<option class="sort btn" value="7">运动</option>
						<option class="sort btn" value="8">代步</option>
					</select>
				</div>
				<div class="row">
					<div class="leftspan text-info"><span>交易方式</span></div>
					<div class="rightspan">
						<label for="rad" class="myradio"><input type="radio" id="rad" name="rad" value="在线交易"/>在线交易</label>
						<label for="rad2" class="myradio"><input type="radio" id="rad2" name="rad" value="线下交易"/>线下交易</label>
						<label for="rad3" class="myradio"><input type="radio" id="rad3" name="rad" value="在线交易/线下交易" checked="checked"/>在线交易/线下交易</label>
					</div>
				</div>
				<div class="row" id="address">
					<div class="leftspan text-info">
						<span>地址</span>
					</div>
					<div class="rightspan" >
						<input type="text" style="width:800px" class="text" name="address"
							placeholder="请输入你地址" />
					</div>
				</div>
				<div class="row">
					<div class="leftspan text-info"><span>手机号</span></div>
					<div class="rightspanlittle">
						<input type="text" class="text" placeholder="请输入手机号" name="phone"/>
					</div>
					<div class="leftspan text-info"><span>QQ号</span></div>
					<div class="rightspanlittle">
						<input type="text" class="text" placeholder="请输入QQ号" name="qq" />
					</div>
					<div class="leftspan text-info"><span>微信号</span></div>
					<div class="rightspanlittle">
						<input type="text" class="text" placeholder="请输入微信号" name="wechat"/>
					</div>
				</div>
				<div class="rowButton">
					<input type="submit" class="btn sure" value="确认发货">
				</div>
			</form>
		</div>
		<div id="footer">
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
		</div>
		<script type="text/javascript" src="../js/fileinput.min.js"></script>
		<script type="text/javascript" src="../js/fileinput_locale_zh.js"></script>
		<script src="../js/index.js"></script>
		<script type="text/javascript">
			$("#Portrait1").fileinput({
				language: 'zh', //设置语言
				//					uploadUrl: upload, //上传的地址
				allowedFileExtensions: ['jpg', 'png', 'gif'], //接收的文件后缀
				uploadAsync: true, //默认异步上传
				showUpload: false, //是否显示上传按钮
				showPreview : true, //是否显示预览
				showCaption: false, //是否显示标题
				browseClass: "btn btn-primary", //按钮样式             
				maxFileCount: 4,
				previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
			});
		</script>
	</body>

</html>