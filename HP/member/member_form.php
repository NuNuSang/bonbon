<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>회원가입</title>
		
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/member.css">
		
		<script>
			function submitForm() {
				if(!document.member_form.id.value) {
					alert("아이디를 입력하세요.");
					document.member_form.id.focus();
					return;
				}
				if(!document.member_form.pass.value) {
					alert("비밀번호를 입력하세요.");
					document.member_form.pass.focus();
					return;
				}
				if(!document.member_form.pass_confirm.value) {
					alert("비밀번호 확인을 입력하세요.");
					document.member_form.pass_confirm.focus();
					return;
				}
				if(!document.member_form.name.value) {
					alert("이름을 입력하세요.");
					document.member_form.name.focus();
					return;
				}
				// 비밀번호와 비밀번호 확인 칸의 입력값이 같은지 비교
				if(document.member_form.pass.value != document.member_form.pass_confirm.value) {
					alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요.");
					document.member_form.pass.focus();
					// 커서가 이동하고 그곳에 써있는 글씨가 선택되어 있음.
					document.member_form.pass.select();
					return;
				}
				
				//form요소를 직접 submit하는 메소드
				document.member_form.submit();
			}
			
			function resetForm() {
				document.member_form.id.value = "";
				document.member_form.pass.value = "";
				document.member_form.pass_confirm.value = "";
				document.member_form.name.value = "";
				document.member_form.email1.value = "";
				document.member_form.email2.value = "";
				
				document.member_form.id.focus();
			}
			
			function checkId() {
				var userid = document.member_form.id.value;
				
				open("./check_id.php?id="+userid, "아이디체크", "width = 300, height = 100, left = 200, top = 100");
			}
		</script>
	</head>
	<body>
		<header>
			<?php include "../lib/header2.php" ?>
		</header>
		
		<section>
			<div id="main_content">
				<div id="join_box">
					<!-- DB의 member테이블에 저장하는 member_insert.php에 입력값들 전달하도록 -->
					<form action="./member_insert.php" method="post" name="member_form">
						<h2>회원 가입</h2>
	 
						<!-- 각 줄마다 라벨, 인풋요소 영역으로 나누어 지므로 col1, col2 클래스지정으로 스타일링 -->
						<div class = "form id">
							<div class = "col1">아이디</div>
							<div class = "col2"><input type = "text" name = "id"></div>
							<!-- id줄만 존재하는 칸 -->
							<div class="col3">
								<a href="#"><button type = "button" onclick = "checkId()">중복확인</button></a>
							</div>
						</div>
						<div class = "form">
							<div class = "col1">비밀번호</div>
							<div class = "col2"><input type = "password" name="pass"></div>
						</div>
						<div class = "clear"></div>
						<div class = "form">
							<div class="col1">비밀번호 확인</div>
							<div class="col2"><input type="password" name="pass_confirm"></div>
						</div>
						<div class = "clear"></div>
						<div class = "form">
							<div class = "col1">이름</div>
							<div class = "col2"><input type="text" name="name"></div>
						</div>
						<div class = "clear"></div>
						<div class = "form email">
							<div class = "col1">이메일</div>
							<div class = "col2">
								<input type = "text" name = "email1">@<input type="text" name="email2">
							</div>
						</div>
						<div class = "clear"></div>
						<!-- input요소의 submit, reset으로 만들면 이미지로 못 만듬 -->
						<!-- input요소의 타입 중 image 타입으로 하면 이미지 버튼이면서 submit 기능 -->
						<!-- 값을 전송할 때 값이 비어있는지 검증하는 작업도 하고 싶어서.. -->
						<!-- Javascript를 이용해서 submit()해보기 -->
						<div class = "bottom_line"></div>
						<div class = "buttons">
							<button type = "button" style = "cursor:pointer" onclick = "submitForm()">가입</button>&nbsp;
							<button type = "button" style = "cursor:pointer" onclick = "resetForm()">리셋</button>
						</div>
					</form>
				</div>	 
			</div>
		</section>
		
		<footer>
			<?php include "../lib/footer.php" ?>
		</footer>
	</body>
</html>
