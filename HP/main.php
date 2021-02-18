<!-- 메인 이미지 영역 -->
<!-- <div id = "main_img_bar">
	<img src = "./img/main_img.jpg">
</div> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div id="main_header" style="width: 100%; height: 270px;">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="carousel-img" src="./img/valentine.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <p class="subtitle"> Valentine Day Recipe</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="carousel-img" src="./img/white.jpg" alt="Second slide">
      		 <div class="carousel-caption d-none d-md-block">
                <p class="subtitle"> White Day Recipe</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="carousel-img" src="./img/christ1.jpg" alt="Third slide">
        	 <div class="carousel-caption d-none d-md-block">
                <p class="subtitle"> Christmas Day Recipe</p>
            </div>
        
        </div>
    </div>
</div>
</div>

<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>


<!-- 최신 게시글 표시 영역 -->
<div id = "main_content">
	<article id = "latest">
		<h4>최신 게시글</h4>
		<ul>
			<?php
				include "./lib/dbconn.php";
				$sql = "SELECT * FROM board ORDER BY boardID DESC LIMIT 5;";
				$result = mysqli_query($conn,$sql);
				
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$boardID = $row['boardID'];
					$title = $row['title'];
					$hit = $row['boardHit'];
					$datetime = $row['boardDatetime'];
			?>
			
			<li>
				<span class = "col1">
					<a href = "./board/boardView.php?boardID=<?=$boardID?>&hit=<?=($hit+1)?>"><?=$title?></a>
				</span>
				<span class = "col2"><?=$datetime?></span>
			</li>
			
			<?php
				}
				mysqli_close($conn);
			?>
		</ul>
	</article>
	
	<!-- 포인트 랭킹 목록 -->
	<article id = "point_rank">
		<h4>포인트 랭킹</h4>
		<ul></ul>
	</article>
</div>
