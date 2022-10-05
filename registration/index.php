<?php 
  require('../common/config.php'); 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
  $email = $_SESSION['email'];
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
		
</body>
</html>