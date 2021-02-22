<?php
    //error_reporting(E_ALL);
	session_start();
	$userid = $_SESSION["userid"];
	
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
					
					$point_up = 10;
					$sql = "SELECT point from user WHERE id = '$userid'";
					$result = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($result);
					$new_point = $row["point"] + $point_up;
					
                    $sql = "UPDATE user SET point = $new_point WHERE id = '$userid'";
					
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
