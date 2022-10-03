<?php
require_once('../common/config.php'); 
if(isset($_GET['id']))
{
    $result = mysqli_query($conn,"SELECT * FROM posts WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);

 $sql_query="DELETE FROM posts WHERE id=".$_GET['id'];
 mysqli_query($conn,$sql_query);
 unlink($row['image']);
 header("Location: post.php");
}
?>