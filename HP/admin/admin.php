<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>관리자 모드</title>
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/admin.css">
	</head>
	<body>
		<header>
			<?php include "../lib/header2.php"; ?>
		</header>
		<section>
			<div id = "main_content">
				<div id = "admin_box">
					<h3>관리자 모드>회원 관리</h3>
					<ul id = "member_list">
						<li>
							<span class = "col1">번호</span>
							<span class = "col2">아이디</span>
							<span class = "col3">이름</span>
							<span class = "col4">레벨</span>
							<span class = "col5">포인트</span>
							<span class = "col6">가입일</span>
							<span class = "col7">수정</span>
							<span class = "col8">삭제</span>
						</li>
						
						<?php
							include "../lib/dbconn.php";
							
							$sql = "SELECT * FROM user ORDER BY num";
							$result = mysqli_query($conn,$sql);
							
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$num = $row['num'];
								$id = $row['id'];
								$name = $row['name'];
								$level = $row['level'];
								$point = $row['point'];
								$regist_day = $row['regist_day'];
						?>
						
						<li>
							<form action = "./admin_member_update.php?num=<?=$num?>" method = "post">
								<span class = "col1"><?=$num?></span>
								<span class = "col2"><?=$id?></span>
								<span class = "col3"><?=$name?></span>
								<span class = "col4"><input type = "text" value = "<?=$level?>" name = "level" style="width:30px; text-align: center;"></span>
								<span class = "col5"><input type = "text" value = "<?=$point?>" name = "point" style="width:40px; text-align: center;"></span>
								<span class = "col6"><?=$regist_day?></span>
								
								<span class = "col7"><button type = "submit">수정</button></span>
								<span class = "col8"><button type = "button" onclick = "location.href = './admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
							</form>
						</li>
						
						<?php
							}
						?>
					</ul>

					<h3>관리자 모드>게시판 관리</h3>
					<ul id="board_list">
                        <li class="title">
                            <span class="col1">선택</span>
                            <span class="col2">번호</span>
                            <span class="col3">작성자</span>
                            <span class="col4">제목</span>
                            <span class="col5">작성일</span>
                        </li>
                        <!-- 표의 내용 레코드들 출력 -->
                        <form action="./admin_board_delete.php" method="post">
                            <?php
                                $sql= "SELECT * FROM board ORDER BY boardID";
                                $result= mysqli_query($conn, $sql);
 
                                while( $row= mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                                    $boardID= $row['boardID'];
                                    $userID= $row['userID'];
                                    $title= $row['title'];
                                    $boardDatetime= $row['boardDatetime'];
                                    // 게시글 등록일자만 .. 시간은 제거
                                    $boardDatetime= substr($boardDatetime, 0, 10);//0번인덱스부터 ~ 10번 인덱스 전까지 문자열 잘라내기
 
                                    // 출력을 위해 php분리
                            ?>
                                <li>
                                    <!-- 삭제를 한번에 제어하기 위해 체크박스 이용해보기 -->
                                    <span class="col1"><input type="checkbox" name="items[]" value="<?=$boardID?>"></span>
                                    <span class="col2"><?=$boardID?></span>
                                    <span class="col3"><?=$userID?></span>
                                    <span class="col4"><?=$title?></span>
                                    <span class="col5"><?=$boardDatetime?></span>
                                </li>
 
                            <?php
                                }
                                mysqli_close($conn);
                            ?>
							
                            <!-- 선택된 글 삭제 버튼 -->
                            <button type="submit">선택된 글 삭제</button>                            
                        </form>
                    </ul>
				</div>
			</div>
		</section>
	</body>
</html>