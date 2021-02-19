<?php

    //error_reporting(E_ALL);

    //ini_set("display_errors", 1);
	$id = $_POST['userid'];
	$title = $_POST['title'];
	$content = $_POST['content'];
    $mode = $_POST['mode'];
    $boardID = $_POST['boardID'];
	$datetime = date("Y-m-d");

    
	include "../lib/dbconn.php";
	
	
	if($title != null) {
        if($content != null) {
            switch($mode){
 
                case 0:
                    $sql = "INSERT INTO board(title, boardContent, boardHit, boardDatetime, userID) VALUES('$title','$content',0,'$datetime','$id');";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);

                    echo ("
                    <script>
                        location.href = './boardList.php';
                    </script>
                    ");
                    break;
                    
                case 1: 
                    $sql = "UPDATE board SET title = '$title', boardContent = '$content' WHERE boardID = $boardID;";
                    
                     mysqli_query($conn,$sql);
                    mysqli_close($conn);

                    echo ("
                    <script>
                        location.href = './boardView.php?boardID=".$boardID."';
                    </script>
                    ");
                    break;
            }    
		    
            
        }else {
            echo("
            <script>
                alert('내용을 입력하세오.');
                history.back();
            </script>
            ");
            exit;
        }

	}
	else{
        echo("
            <script>
                alert('제목을 입력하세오.');
                history.back();
            </script>
        
        
        ");
        exit;
        
    }
        
?>
