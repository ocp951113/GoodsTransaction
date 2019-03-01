<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-3.1.1.js"></script>
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/radio.css" />
		<link rel="stylesheet" href="../css/fileinput.min.css" />
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="../js/prefixfree.min.js"></script>
		<script src="../js/modernizr.js"></script>

		<link rel="stylesheet" href="../css/home.css" />
		<link rel="stylesheet" href="../css/user.css" />
	</head>

	<body>
		<?php 
			session_start(); 
			$avatar = null;
			$db = @new mysqli('127.0.0.1','root', '123456');
		    if ($db->connect_error)	
		      die('链接错误: '. $db->connect_error);
		    $db->query('SET webershou "utf-8"');//UTF8
			$db->select_db('webershou') or die('不能连接数据库');
			
			if(isset($_FILES['pic'])){
				if(is_uploaded_file($_FILES['pic']['tmp_name'])){
					$file = $_FILES['pic'];
					$avatar = $file["name"];
					$save='../upload/pic/user/'.$avatar;
					move_uploaded_file($_FILES['pic']['tmp_name'],$save);
					$_SESSION['userPicSrc'] = $avatar;
					
					$nickname = $_POST['nickname'];
					$psw = $_POST['psw'];
					$gexingqianming = $_POST['gexingqianming'];
					$sex = $_POST['rad'];
					$sql = "update user set password='".$psw."',userName='".$nickname."',userPicSrc='".$avatar."',signature='".$gexingqianming."' where userId=".$_SESSION['userId'];
					$result = $db->query($sql);
					
					if($result){
						$_SESSION['userName'] = $nickname;
						$_SESSION['userPicSrc'] = $avatar;
						$_SESSION['user']['signature'] = $gexingqianming;
					}
					
				}
			
			}
				
		?>
		
		<div id="header">
			<div class="header-wrap">
				<a href="" class="logo fl">
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
							<a href="userPublish.php" class="" style="text-decoration: none;">我发布的</a>
						</li>
						<li>
							<a href="want.php" class="" style="text-decoration: none;">我想要的</a>
						</li>
						<li>
							<a href="words.php" class="" style="text-decoration: none;">我的留言</a>
						</li>
						<li>
							<a href="userinfo.php" class="active" style="text-decoration: none;">个人信息</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="user-main userinfo fr">
				<form action="userinfo.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="img-left fl">头像</div>
						<div class="img-center fl">
							<img src="../upload/pic/user/<?php if($avatar != null){ echo $avatar;}else{echo $_SESSION['userPicSrc'];} ?>" class="user-info-picture">
						</div>
						<div class="img-right fl">
							<input id="Portrait1" type="file" name="pic" class="change-picture" value="修改头像">
						</div>
					</div>
	
					<div class="row">
						<div class="left fl"><em>*</em> 昵称</div>
						<div class="center fl">
							<input type="text" name="nickname" class="text" value="<?php echo $_SESSION['userName'];?>">
						</div>
						<div class="right fl">3-16位 汉字、数字、字母（大小写）、下划线组成</div>
					</div>
					
					<div class="row">
						<div class="left fl">个性签名</div>
						<div class="center fl">
							<input type="text" name="gexingqianming" class="text" style="width: 592px;" value="<?php echo $_SESSION['user']['signature']; ?>">
						</div>
					</div>
					<div class="row">
						<div class="left fl"><em>*</em> 密码</div>
						<div class="center fl">
							<input type="text" name="psw" class="text" value="<?php echo $_SESSION['user']['password'];?>">
						</div>
					</div>
					<div class="row">
						<div class="left fl"><em>*</em> 性别</div>
						<div class="center fl">
							<?php if($_SESSION['user']['sex'] == "男"){?>
								<label for="rad" class="myradio"><input type="radio" id="rad" name="rad" checked="checked" value="男"/>男</label>
								<label for="rad2" class="myradio"><input type="radio" id="rad2" name="rad" value="女"/>女</label>
							<?php }else{ ?>
								<label for="rad" class="myradio"><input type="radio" id="rad" name="rad" value="男"/>男</label>
								<label for="rad2" class="myradio"><input type="radio" id="rad2" name="rad" checked="checked" value="女"/>女</label>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="left fl">&nbsp;</div>
						<div class="center fl">
							<input type="submit" class="btn btn-primary" value="保存修改">
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="../js/fileinput.min.js"></script>
		<script type="text/javascript" src="../js/fileinput_locale_zh.js"></script>
		<script src="../js/index.js"></script>
		<script type="text/javascript">
			$("#Portrait1").fileinput({
				language: 'zh', //设置语言
				uploadUrl: "../upload/pic/user", //上传的地址
				allowedFileExtensions: ['jpg', 'png', 'gif'], //接收的文件后缀
				uploadAsync: true, //默认异步上传
				showUpload: false, //是否显示上传按钮
				showPreview: false, //是否显示预览
				showCaption: false, //是否显示标题
				showRemove: false, //显示移除按钮
				browseClass: "btn btn-primary", //按钮样式             
				maxFileCount: 4,
				previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
			});
		</script>
	</body>

</html>