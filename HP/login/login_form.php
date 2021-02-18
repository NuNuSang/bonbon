<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>로그인</title>
		
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/login.css">
	</head>
	<body>
		<header>
			<?php include "../lib/header2.php"; ?>
		</header>
		
		<section>
			<div id = "main_content">
				<div id = "login_box">
					<div id = "login_title">로그인</div>
					<div id = "login_form">
						<form action = "./login.php" method = "post">
							<ul>
								<li><input type="text" name="id" placeholder="아이디"></li>
								<li><input type="password" name="pass" placeholder="비밀번호"></li>
							</ul>
							<div id = "login_btn">
								<button type="submit">로그인</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		<footer>
			<?php include "../lib/footer.php"; ?>
		</footer>
	</body>
</html>
