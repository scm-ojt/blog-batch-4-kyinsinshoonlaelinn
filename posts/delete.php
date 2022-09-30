<?php
require_once('../common/config.php'); 
if(isset($_GET['id']))
{
 $sql_query="DELETE FROM posts WHERE id=".$_GET['id'];
 mysqli_query($conn,$sql_query);
 header("Location: post.php");
}
?>