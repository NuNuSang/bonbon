<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>게시판</title>
		
        <script src="./js/jquery-3.1.1.min.js"></script> 
        <script src="./js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="./css/bootstrap.min.css"> 
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css">
        
		<link rel = "stylesheet" href = "../css/common.css">
		<link rel = "stylesheet" href = "../css/boardList.css">
	</head>
	
	<body>
		<header>
			<?php include "../lib/header2.php"; ?>
		</header>
		
		<section>
			<div id = "main_content">
				<div id = "boardList">
				<h3>
				    게시판
				</h3>
				
				<div>
					<ul id = "post">
						<li>
							<span class = "col1">번호</span>
							<span class = "col2">제목</span>
							<span class = "col3">작성자</span>
							<span class = "col4">등록일</span>
							<span class = "col5">조회수</span>
						</li>
						
						<?php
							include "../lib/dbconn.php";
							$sql="SELECT * FROM board ORDER BY boardID DESC;";
							$result = mysqli_query($conn,$sql);
							$rowNum = mysqli_num_rows($result);
							if(isset($_GET['page']) ) $page= $_GET['page'];
                            else  $page=1;
 
                            if( $rowNum %10 == 0) $total_page= floor($rowNum/10);
                            else $total_page= floor($rowNum/10)+1;
 
                            if($total_page==0) $total_page=1;
 
                            $start= ($page -1)*10;
                            for($i=$start; $i<$start+10 && $i<$rowNum; $i++){
                  
                                mysqli_data_seek($result, $i);
 
                                $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $boardID= $row['boardID'];
                                $title= $row['title'];
                                $content= $row['boardContent'];
                                $hit = $row['boardHit'];
                                $writerID = $row['userID'];
                                $datetime = $row['boardDatetime'];
                                
                                
						?>
                    
								<li>
									<span class="col1"><?=$boardID?></span>
                                    <span class="col2">
                                    <a href="./boardView.php?boardID=<?=$boardID?>&hit=<?=($hit+1)?>">
                                    <?=$title?></a></span>
                                    <span class="col3"><?=$writerID?></span>
                                    <span class="col4"><?=$datetime?></span>
                                    <span class="col5"><?=$hit?></span>
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
								echo "<li><a href = './boardList.php?page=$newPage'>◀이전 </a></li>";
                            }else {
                                echo "<li>◀이전 </li>";
                            }
							
							for($i = 1; $i <= $total_page; $i++) {
								if($i == $page) echo "<li><strong>$i</strong></li>";
                                else echo "<li><a href='./boardList.php?page=$i'> $i</a></li>";
                            }
							
							if($page!=$total_page){
                                $newPage= $page+1;
                                echo "<li><a href='./boardList.php?page=$newPage'> 다음▶</a></li>";
                            }else{
                                echo "<li> 다음▶</li>";
                            }
						?>
					</ul>
					
					<ul class = "buttons">
						<li><button class="btn btn-primary" onclick="location.href='./boardForm.php?mode=0'">글쓰기</button></li>
                    </ul>
				</div>
			</div>
		</section>
		
		<footer>
			<?php include "../lib/footer.php"; ?>
		</footer>
	</body>
</html>


