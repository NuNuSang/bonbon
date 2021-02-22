<?php
session_start();
$userid = $_SESSION["userid"];
error_reporting(E_ALL);

ini_set("display_errors", 1);


	$userID = $_POST['userID'];
	$content = $_POST['content'];
    $boardID = $_POST['boardID'];
	$datetime = date("Y-m-d");

    include "../lib/dbconn.php";



    if($content != null) {

        $sql = "INSERT INTO boardcomment(commentContent, commentDatetime, boardID, userID) VALUES('$content','$datetime','$boardID','$userID');";

        mysqli_query($conn,$sql);
		
		$point_up = 5;
		$sql = "SELECT point from user WHERE id = '$userid'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$new_point = $row["point"] + $point_up;
					
        $sql = "UPDATE user SET point = $new_point WHERE id = '$userid'";					
		mysqli_query($conn,$sql);
		
        mysqli_close($conn);

        echo ("<script>
                    location.href='boardView.php?boardID=".$boardID."';
            </script>");

    }else {
    echo("
        <script>
            alert('내용을 입력하세오.');
            history.back();
        </script>
        ");
    exit;
    }

?>
