<?php
	$userid = "";
	$username = "";
	$userlevel = "";
	$userpoint = "";

	if(isset($_SESSION['userid'])) $userid = $_SESSION['userid'];
	if(isset($_SESSION['username'])) $username = $_SESSION['username'];
	if(isset($_SESSION['userlevel'])) $userlevel = $_SESSION['userlevel'];
    if(isset($_SESSION['userpoint'])) $userpoint = $_SESSION['userpoint'];
?>

<div id = "top">
	<!-- 로고 영역 -->
    <h3><a href="../index.php"><img src = "../img/imsi.jpg"></a></h3>
	<!--<h3><a href="../index.php">레시피</a></h3>-->
	
	<!--회원가입/로그인 버튼 표시 영역-->
	<ul id = "top_menu">
		<?php if(!$userid){ ?>
			<li><a href="../member/member_form.php">회원가입</a></li>
			<li> | </li>
			<li><a href="../login/login_form.php">로그인</a></li>
		<?php }else{ ?>
            <li><a href="../login/logout.php">로그아웃</a></li>
            <li> | </li>
            <li><a href="../login/member_modify_form.php">정보수정</a></li>
        <?php }?>
		
		<!-- 관리자 모드로 로그인 되었을때-->
		<?php if($userlevel==1){ ?>
			<li>|</li>
			<li><a href="../admin/admin.php">관리자모드</a></li>
		<?php } ?>
	</ul>
</div>

<!-- 헤더 영역의 네비게이션 메뉴 영역 -->
<div id = "menu_bar">
	<ul>
		<li><a href="../index.php">HOME</a></li>
		<li><a href="../message/message_form.php">쪽지</a></li>
		<li><a href="../recipe/recipe_main.php?category=1">레시피</a></li>
		<li><a href="../board/boardList.php">게시판</a></li>
	</ul>
</div>
