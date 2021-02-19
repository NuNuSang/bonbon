<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>레시피 작성</title>

    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/recipeForm.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>

</head>

<body>
    <header>
        <?php include "../lib/header2.php" ?>
    </header>
    <section>
        <div id="main_content">
            <div id="writeRecipe">
                <h3 id="write_title">레시피 작성</h3>



                <form method="post" name="recipeForm" action="./recipeSubmit.php" enctype="multipart/form-data">
                    <div id="writePost">
                        <ul>
                           <li>
                               <span class="col1">카레고리</span>
                               <span class="co12">
                                   <select name="selectCategory">
                                       <option value="0">선택해주세요</option>
                                       <option value="1">카테(1)</option>
                                       <option value="2">고리(2)</option>
                                       <option value="3">넣어(3)</option>
                                       <option value="4">주세(4)</option>
                                       <option value="5">요!(5)</option>
                                       
                                   </select>
                                   
                               </span>
                               
                           </li>
                            <li>
                                <span class="col1">글쓴이 : </span>
                                <span class="col2"><?=$userid?></span>
                                <input type="hidden" value="<?=$userid?>" name="userid">
                                <!--<input type="hidden" value="<?//=$mode?>" name="mode">-->

                            </li>
                            <li>
                                <span class="col1">제목 : </span>
                                <span class="col2"><input type="text" name="recipeName"></span>
                            </li>
                            <li id="textarea">
                                <span class="col1">재료 : </span>
                                <span class="col2"><textarea name="ingredient"></textarea></span>
                            </li>
                            <li id="textarea">
                                <span class="col1">소개글 : </span>
                                <span class="col2"><textarea name="intro"></textarea></span>
                            </li>

                        </ul>
                    </div>


                    <div id="writeManual">
                        <p style="padding:10px">레시피</p>
                        <div id="inputManual1">
                            <ul>
                                <li>
                                    <image class="addImage" src="../img/noimage.png" id="preview1">
                                        </br><input type="file" id="addImageFile1" name="addImageFile1" onchange="javascript:readURL(this, 1)">
                                </li>
                                <li><textarea name="manualContent1" id="manualContent1"></textarea></li>

                            </ul>
                            <!--내가 이겼다 시발롬들아 ㅋㅋ-->
                            <div id="inputManual2">
                            </div>
                        </div>

                    </div>



                    <div id="addBtn">
                        <button type="button" class="addManual" onclick="addInput(this)">추가</button>

                    </div>
                    

                    <p style="padding:10px">완성사진</p>
                    <div id="repImage">
                       <!--TODO: 다중 파일 업로드로 수정해서 여러 개 넣을 수 있게 하기-->
                        <ul>
                                <li>
                                    <image class="completeImage" src="../img/noimage.png" id="cPreview1">
                                        </br><input type="file" id="completeImageFile1" name="completeImageFile1" onchange="javascript:readURL2(this, 1)">
                                </li>   
                            </ul>
                    </div>
                    <div id="submitBtn">
                        <input type="submit" value="등록하기">
                        <button type="button" onclick="location.href='./recipe_main.php?category=1'">취소하기</button>

                    </div>
                </form>



            </div>
        </div>
    </section>




    <footer>
        <?php include "../lib/footer.php" ?>
    </footer>

</body>

</html>


<script>
    var count = 1;

    function addInput(f) {

        var i;
        if (count >= 15)
            return;
        count++;

        app = document.getElementById("inputManual" + count);
        app.innerHTML += '<ul><li><image class="addImage" src = "../img/noimage.png"  id="preview' + count + '"></br><input type="file" name="addImageFile' + count + '"id="addImageFile' + count + '"onchange="javascript:readURL(this, ' + count + ')"></li><li><textarea name ="manualContent' + count + '"id="manualContent' + count + '"></textarea></li></ul><div id="inputManual' + (count + 1) + '"></div>';

    }

    /*함수 하나로 합치기*/
    function readURL(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#preview" + i).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#cPreview" + i).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
