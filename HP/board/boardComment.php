<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/boardComment.css">



<div id="printComment">

    <?php 

        include "../lib/dbconn.php";
        $sql="SELECT * FROM boardcomment where boardID = ".$boardID." ORDER BY commentID ASC;";
        $result = mysqli_query($conn,$sql); 
        if($result!=null){
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $commentcontent = $row['commentContent'];
                $commentDatetime = $row['commentDatetime'];
                $commentUserID = $row['userID'];
                $commentcontent = nl2br($commentcontent);
        
    ?>

    <ul>
        <li>
            <strong><span><?=$commentUserID?></span></strong>
            <span> <?=$commentDatetime?></span>
        </li>
        <li>
            <?=$commentcontent?>
        </li>

    </ul>
    <?php } 
        }?>


</div>
<div id="comment">
    <form action="./boardCommentSubmit.php" method="post" name="commentForm">

        <ul id="commentForm">
            <li>
                <strong><span><?=$userid?></span></strong>
                <input type="hidden" value="<?=$userid?>" name="userID">
                <input type="hidden" value="<?=$boardID?>" name="boardID">
            </li>
            <li id="textarea">
                <textarea name="content"></textarea>
                <input type="submit" class="btn btn-primary" value="등록하기">
            </li>

        </ul>

    </form>
</div>
