<?php
	session_start();
	
	$num = $_GET["num"];
	
	include "../lib/dbconn.php";
	
	$sql = "DELETE from user WHERE num = $num";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	
	echo "
    <script>
        location.href = './admin.php';
    </script>
	";
?>