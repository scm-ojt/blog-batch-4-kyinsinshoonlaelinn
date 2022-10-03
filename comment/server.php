<?php
    $db = mysqli_connect('localhost', 'root', 'root', 'blog');
    $posts_id = "";
    $user_id = "";
    $body = "";
    $pid = "";
    $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
    $created_date = $dt->format('Y.m.d , h:i:s');
    if (isset($_POST['reg_cmt'])) {
        $posts_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $body = $_POST['body'];
        $query = "INSERT INTO comments (posts_id, user_id, body, created_date) 
  			  VALUES('$posts_id', '$user_id', '$body', '$created_date')";
  	    mysqli_query($db, $query);

        $redirct = "SELECT * from comments where posts_id = '".$posts_id."'";
        $fresult = mysqli_query($db, $redirct);
        $pid = mysqli_fetch_assoc($fresult);
        header("location: ../posts/detail.php?id=".urlencode($pid['posts_id']));
    }
    if(isset($_POST['edit_cmt'])) {
        $redirct = "SELECT * from comments where id = '".$_POST['id']."'";
        $result = mysqli_query($db, $redirct);
        $pid = mysqli_fetch_assoc($result);  

        $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
        $updated_date = $dt->format('Y.m.d , h:i:s');
        $query = "UPDATE comments SET body = '".$_POST['body']."', updated_date = '".$updated_date."' WHERE id='".$_POST['id']."'";
        mysqli_query($db, $query);          
        header("location: ../posts/detail.php?id=".urlencode($pid['posts_id']));
    }
?>