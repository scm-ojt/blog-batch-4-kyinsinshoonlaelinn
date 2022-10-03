<?php require_once('../common/config.php'); 
if(isset($_GET['id']))
{
    $redirct = "SELECT * from comments where id = '".$_GET['id']."'";
    $result = mysqli_query($conn, $redirct);
    $pid = mysqli_fetch_assoc($result); 

    $sql_query="DELETE FROM comments WHERE id='".$_GET['id']."'";
    mysqli_query($conn, $sql_query);

    header("location: ../posts/detail.php?id=".urlencode($pid['posts_id']));
}
 
?>