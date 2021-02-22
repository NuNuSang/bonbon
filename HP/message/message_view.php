<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>내용 보기</title>
		
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/message_view.css">
	</head>
	<body>
		<header>
			<?php include "../lib/header2.php" ?>
		</header>
		
		<section>
			<div id = "main_content">
				<div id="message_box">
					<h3>
						<?php $mode = $_GET['mode'];?>
						<?=($mode=="send")?"송신 쪽지함>내용보기":"수신쪽지함>내용보기"?>
					</h3>
					
					<?php
						$num = $_GET['num'];
						
						include "../lib/dbconn.php";
						
						$sql = "SELECT * FROM message WHERE num = $num";
						$result = mysqli_query($conn,$sql);
						
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$send_id = $row['send_id'];
						$rv_id = $row['rv_id'];
						$regist_day = $row['regist_day'];
						$subject = $row['subject'];
						$content = $row['content'];
						
						//$content는 줄바꿈 있을 수 있음
						$content = str_replace("\n", "<br>", $content);
						$content = str_replace(" ","&nbsp", $content);
						
						$msg_id = ($mode == "send")?$rv_id:$send_id;
					?>
					
					<ul id = "view_content">
						<li>
							<span class = "col1"><strong>제목: </strong><?=$subject?></span>
							<span class = "col2"><strong><?=$msg_id?></strong> | <?=$regist_day?></span>
						</li>
						<li>
							<?=$content?>
						</li>
					</ul>
					
					<!--버튼들~~-->
					<ul class = "buttons">
						<li><button class="btn btn-primary" onclick = "location.href = './message_box.php?mode=rv'">수신 쪽지함</button></li>
						<li><button class="btn btn-primary" onclick = "location.href = './message_box.php?mode=send'">송신 쪽지함</button></li>
						
						<li><button class="btn btn-primary" onclick = "location.href = './message_delete.php?num=<?=$num?>& mode=<?=$mode?>'">삭제</button></li>
					</ul>
				</div>
			</div>
		</section>
		<footer>
			<?php include "../lib/footer.php"; ?>
		</footer>
	</body>
</html>
