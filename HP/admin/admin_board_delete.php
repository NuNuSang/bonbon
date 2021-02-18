<?php

//체크박스 누르지 않고 삭제 누르는 경우
	if(!isset($_POST['items'])) {
		echo "
			<script>
				alert('삭제할 게시글을 선택하세요.');
				history.go(-1);
			</script>
		";
		exit;
	}
	
	include "../lib/dbconn.php";
	
	$items = $_POST['items'];
	
	$itemNum = count($items);
	
	for($i = 0; $i < $itemNum; $i++) {
		$boardID = $items[$i];
		
		$sql = "DELETE FROM board WHERE boardID = $boardID";
		mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	
	echo "
		<script>
			location.href = './admin.php';
		</script>
	";
?>