<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>레시피</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/recipeView.css">
</head>

<body>
    <header>
        <?php include "../lib/header2.php"?>
    </header>

    <section>

        <div id="main_content">
            <div id="viewRecipe">

                <?php
                    if(isset($_GET['recipeID'])){
                    $recipeID = $_GET['recipeID'];

                    include "../lib/dbconn.php";

                    $sql = "select * from recipe where recipeID = $recipeID";

                    $result = mysqli_query( $conn, $sql );
                    $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

                    $recipeName = $row['recipeName'];
                    $recipeDatetime = $row['recipeDatetime'];
                    $ingredient  = $row['ingredient'];
                    $recipeHit = $row['recipeHit'];
                    $recipeWriter = $row['userID'];
                    $intro = $row['intro'];
                    $i = 1;
                    $count = 0;

                    //메뉴얼 존재여부 확인, 개수 체크
                    while($i < 16){

                        if($row["manual$i"]!=null){

                            ${"manual".$i} = $row["manual$i"];
                            ${"manualImage".$i} = $row["manualImage$i"];
                            $count++;
                            $i++;

                        }
                        else {

                            break;
                        }

                    }

?>

                <hr>
                <ul id="viewContent">
                    <li>
                        <span class="col1"><strong><?=$recipeName?></strong></span>
                        <span class="col2">
                            <strong><?=$recipeWriter?></strong> | <?=$recipeDatetime?> |
                            <button onclick="javascript:editPost(1)">수정</button>
                            <button onclick="javascript:editPost(2)">삭제</button>
                        </span>

                    </li>
                    <li>
                      <p>재료: <?=$ingredient?></p>
                        <p> 소개: <?=$intro?> </p>
                       <!--메뉴얼 출력-->
                        <?php 
                            for($k=1; $k <= $count; $k++){
                                
                                echo '<image width="200px" height="auto"src ="'. ${"manualImage".$k}.'">';
                                
                                echo '<p>'.$k.' - '.${"manual".$k}.'</p>';                                
                            }
                        
                        
                        ?>
                    </li>
                </ul>

            </div>
            
            <?php }
                        /*else {
                                
                                echo '<script> alert("잘못된 접근입니다.");
                                history.back();
                                </script>';
                            }
            
            */
            ?>
        </div>

    </section>

    <footer>
        <?php include "../lib/footer.php" ?>
    </footer>

</body>

</html>
