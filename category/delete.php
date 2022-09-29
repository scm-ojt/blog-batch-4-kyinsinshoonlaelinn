<?php
require_once('../common/config.php'); 
if(isset($_GET['id']))
{
 $sql_query="DELETE FROM categories WHERE id=".$_GET['id'];
 mysqli_query($conn,$sql_query);
 header("Location: category.php");
}
?>