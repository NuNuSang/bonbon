<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>쪽지함</title>
		
        <script src="./js/jquery-3.1.1.min.js"></script> 
        <script src="./js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="./css/bootstrap.min.css"> 
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css">
        
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/message_box.css">
	</head>
	
	<body>
		<header>
			<?php include "../lib/header2.php"; ?>
		</header>
		
		<section>
			<div id = "main_content">
				<div id = "message_box">
				<h3>
					<?php
						$mode = $_GET['mode'];
						if($mode=="send") echo "송신 쪽지함>목록보기";
						else echo "수신 쪽지함>목록보기";
					?>
				</h3>
				
				<div>
					<ul id = "message">
						<li>
							<span class = "col1">번호</span>
							<span class = "col2">제목</span>
							<span class = "col3"><?=($mode=="send")?"받은이":"보낸이" ?></span>
							<span class = "col4">등록일</span>
						</li>
						
						<?php
							include "../lib/dbconn.php";
							if($mode == "send") {
								$sql="SELECT * FROM message WHERE send_id='$userid' ORDER BY num desc";
                            }else { //수신 쪽지함이면 'userid'가 rv_id로 저장되어 있는 리스트만
                                $sql="SELECT * FROM message WHERE rv_id='$userid' ORDER BY num desc";
                            }
							
							$result = mysqli_query($conn,$sql);
							$rowNum = mysqli_num_rows($result);
							
							if(isset($_GET['page']) ) $page= $_GET['page'];
                            else  $page=1;
 
                            // 전체 페이지 수 계산  1~10 : 1page, 11~20: 2page, 21~30: 3page ....
                            if( $rowNum %10 == 0) $total_page= floor($rowNum/10);
                            else $total_page= floor($rowNum/10)+1;
 
                            if($total_page==0) $total_page=1;
 
                            // 현재페이지에서 시작할 쪽지글의 row 번호 (num값 아님)
                            $start= ($page -1)*10; // 1page row=0부터, 2page row=10부터
 
                            for($i=$start; $i<$start+10 && $i<$rowNum; $i++){
                                //가져올 레코드의 위치(row 위치) 이동
                                mysqli_data_seek($result, $i);
 
                                $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $num= $row['num'];
                                $subject= $row['subject'];
                                // $content= $row['content'];
                                $msg_id= ($mode=="send_id")? $row['rv_id']: $row['send_id'];
                                $regist_day= $row['regist_day'];
						?>
								<li>
									<span class="col1"><?=$num?></span>
                                    <span class="col2"><a href="./message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
                                    <span class="col3"><?=$msg_id?></span>
                                    <span class="col4"><?=$regist_day?></span>
                                </li>
								
							<?php
							}
							mysqli_close($conn);
							?>
					</ul>
					<ul id = "page_num">
						<?php
							if($page != 1) {
								$newPage = $page - 1;
								echo "<li><a href = './message_box.php?mode=$mode&page=$newPage'>◀이전 </a></li>";
                            }else {
                                echo "<li>◀이전 </li>";
                            }
							
							//페이지 수만큼 페이지 번호 출력
							for($i = 1; $i <= $total_page; $i++) {
								if($i == $page) echo "<li><strong>$i</strong></li>";
                                else echo "<li><a href='./message_box.php?mode=$mode&page=$i'> $i</a><</li>";
                            }
							
							if($page!=$total_page){
                                $newPage= $page+1;
                                echo "<li><a href='./message_box.php?mode=$mode&page=$newPage'> 다음▶</a></li>";
                            }else{
                                echo "<li> 다음▶</li>";
                            }
						?>
					</ul>
					
					<ul class = "buttons">
						<li><button class="btn btn-primary" onclick="location.href='./message_box.php?mode=rv'">수신 쪽지함</button></li>
                        <li><button class="btn btn-primary" onclick="location.href='./message_box.php?mode=send'">송신 쪽지함</button></li>
                        <li><button class="btn btn-primary" onclick="location.href='./message_form.php?mode=rv'">쪽지 보내기</button></li>
                    </ul>
				</div>
			</div>
		</section>
		
		<footer>
			<?php include "../lib/footer.php"; ?>
		</footer>
	</body>
</html>