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
    <link rel="stylesheet" href="../css/recipe.css">
</head>

<body>
    <header>
        <?php include "../lib/header2.php"?>
    </header>

    <section>
        <div id="main_content">
            <div id="wrapper">
                <div class="clear" id="sidebar">
                    <ul id="recipe_menu">
                        <li><a href="?category=1">카테고리</a></li>
                        <li><a href="?category=2">설정</a></li>
                        <li><a href="?category=3">부탁</a></li>
                        <li><a href="?category=4">드립</a></li>
                        <li><a href="?category=5">니다</a></li>
                    </ul>
                </div>

                <div id="menu_content">
                    <div class="factor text-center">

                        <?php 
    
                        include "../lib/dbconn.php";
                        if(isset($_GET['category'])){

                            $category = $_GET['category'];
                            $sql = "SELECT * FROM recipe WHERE category = $category;";

                            $result = mysqli_query($conn,$sql);

                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $recipeID= $row['recipeID'];
                                $recipeName= $row['recipeName'];
                                $writerID = $row['userID'];
                                $repImage = $row['repImage'];
                                ?>
                        <div class="col-xs-4 product">
                            <img src="<?=$repImage?>" width="150px" height="150px">
                            <p style='margin-top: 10px;'><a href='./recipeView.php?recipeID=<?=$recipeID?>'><?=$recipeName?></a></p>
                            <p><?=$writerID?></p>
                        </div>

                        <?php
                                }
                            } /*else {
                                
                                echo '<script> alert("잘못된 접근입니다.");
                                history.back();
                                </script>';
                            }*/
                        ?>


                    </div>

                </div>
                
                <div id="writeRecipeBtn">

                    <button type="button" onclick="location.href='./recipeForm.php?mode=0'">레시피 작성</button>
                    
                </div>
            </div>
        </div>


    </section>

    <footer>
        <?php include "../lib/footer.php"?>
    </footer>

</body>

</html>
