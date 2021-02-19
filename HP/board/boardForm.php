<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>게시글 작성</title>

    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/boardForm.css">
</head>

<body>
    <header>
        <?php include "../lib/header2.php" ?>
    </header>
    <section>
        <div id="main_content">
            <div id="writeBoard">
                <h3 id="write_title">게시글 작성</h3>


                <?php 
                    $mode = $_GET['mode'];
                   
                    if($mode==0){     
        
                    ?>
                <form action="./boardSubmit.php" method="post" name="boardForm">
                    <div id="writePost">
                        <ul>
                            <li>
                                <span class="col1">글쓴이 : </span>
                                <span class="col2"><?=$userid?></span>
                                <input type="hidden" value="<?=$userid?>" name="userid">
                                <input type="hidden" value="<?=$mode?>" name="mode">
                    
                            </li>
                            <li>
                                <span class="col1">제목 : </span>
                                <span class="col2"><input type="text" name="title"></span>
                            </li>
                            <li id="textarea">
                                <span class="col1">내용 : </span>
                                <span class="col2"><textarea name="content"></textarea></span>
                            </li>
                        </ul>
                        <input type="submit" value="등록하기">


                    </div>
                </form>

                <?php } 
        
                    if($mode==1){  
                        $boardID = $_GET['boardID'];
                        include "../lib/dbconn.php";
                        $sql = "SELECT * FROM board where boardID = ".$boardID .";";
                        $result = mysqli_query($conn,$sql);
                        $row= mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        $title = $row['title'];
                        $boardContent = $row['boardContent'];
                        $writerID = $row['userID'];
                        
                        
                        
        
                    ?>
                <form action="./boardSubmit.php" method="post" name="boardForm">
                    <div id="writePost">
                        <ul>
                            <li>
                                <span class="col1">글쓴이 : </span>
                                <span class="col2"><?=$userid?></span>
                                <input type="hidden" value="<?=$userid?>" name="userid">
                                <input type="hidden" value="<?=$mode?>" name="mode">
                                <input type="hidden" value="<?=$boardID?>" name="boardID">
                            </li>
                            <li>
                                <span class="col1">제목 : </span>
                                <span class="col2"><input type="text" value="<?=$title?>" name="title"></span>
                            </li>
                            <li id="textarea">
                                <span class="col1">내용 : </span>
                                <span class="col2"><textarea name="content"><?=$boardContent?></textarea></span>
                            </li>
                        </ul>
                        <input type="submit" value="등록하기">


                    </div>
                </form>


                <?php } 
                
                if($mode == 2){
                    $boardID = $_GET['boardID'];
                    include "../lib/dbconn.php";
      
                     $sql = "DELETE FROM board where boardID = ".$boardID .";";
                     mysqli_query($conn,$sql);
                     mysqli_close($conn);
                    
                    echo "<script>
                    
                        alert('삭제완료!');
                        location.href = './boardList.php';
                    </script>";
                    
                    
                }
                
                
                ?>

            </div>
        </div>
    </section>




    <footer>
        <?php include "../lib/footer.php" ?>
    </footer>

</body>

</html>
