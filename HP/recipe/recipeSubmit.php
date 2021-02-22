<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$userid = $_POST['userid'];
$recipeName = $_POST['recipeName'];
$ingredient = $_POST['ingredient'];
$intro = $_POST['intro'];
$selectCategory = $_POST['selectCategory'];
$count = 0;
$datetime = date("Y-m-d");
$mode = 0;
$targetDir = "../upload/";

//업로드 경로 upload 폴더 (생성해야됨), 세분화 하기

for($i=1; $i <= 15; $i++){
    
    if(isset($_FILES["addImageFile$i"])){

        ${"addImageFile$i"} = $targetDir . basename($_FILES["addImageFile$i"]["name"]);
            //$_FILES["addImageFile$i"];
        ${"manualContent$i"} = $_POST["manualContent$i"];
        $count++;
    }
}
if(isset($_FILES['completeImageFile1'])){

        $completeImageFile1 = $targetDir . basename($_FILES["completeImageFile1"]["name"]);
      
    }

include "../lib/dbconn.php";

//TODO: 입력 안했을 시 예외 설정 하기, 현재는 입력 안하면 DB에 null값이 들어감
if ( $recipeName != null ) {
    if($selectCategory != 0){
   
        //switch( $mode ) {

            //case 0:
            move_uploaded_file($_FILES["completeImageFile1"]['tmp_name'],$completeImageFile1); 
            $insertSql = "insert into recipe(recipeName, recipeDatetime, ingredient, userID, category, intro, repImage";
            $valueSql = "values ('$recipeName', '$datetime', '$ingredient','$userid',$selectCategory,'$intro', '$completeImageFile1'";
            for($i=1; $i<=$count; $i++){
                
                $insertSql .= ",manualImage$i, manual$i";
                $valueSql .= ",'". ${"addImageFile".$i} ."','" . ${"manualContent".$i}."'";
            }
                
            $insertSql.=') ';
            $valueSql.=');';
            $sql = $insertSql . $valueSql;
                
            echo $sql;
    
        for($i=1; $i<=$count; $i++){
                $r = move_uploaded_file($_FILES["addImageFile$i"]['tmp_name'],${"addImageFile$i"});  
            }
                    mysqli_query( $conn, $sql );
					
					$point_up = 20;
					$sql = "SELECT point from user WHERE id = '$userid'";
					$result = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($result);
					$new_point = $row["point"] + $point_up;
					
					$sql = "UPDATE user SET point = $new_point WHERE id = '$userid'";
					
					mysqli_query($conn,$sql);
                    mysqli_close( $conn );
    
     echo ("
                    <script>
                        location.href = './recipe_main.php?category=1';
                    </script>
                    ");
            
                
    }else {
    echo( "
            <script>
                alert('카테고리를 선택하세요.');
                history.back();
            </script>
        
        
        " );
    exit;

}
       
    
}
           
else {
    echo( "
            <script>
                alert('제목을 입력하세오.');
                history.back();
            </script>
        
        
        " );
    exit;

}
?>
