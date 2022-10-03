<?php
    include('server.php'); 
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
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

    $cresult = mysqli_query($db,"SELECT * FROM comments WHERE id='" . $_GET['id'] . "'");
    $comment = mysqli_fetch_assoc($cresult);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Details</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="multiselect/jquery.multiselect.js"></script>
</head>
<body>
<div class="header">
    <!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../posts/post.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">Categories<i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="#" class="w3-bar-item w3-button">Merchandise</a>
        <a href="#" class="w3-bar-item w3-button">Extras</a>
        <a href="#" class="w3-bar-item w3-button">Media</a>
      </div>
    </div>
    <a href="../posts/post.php?user_id=<?php echo $row['id']; ?>" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Post List</a>
    <?php  if (isset($_SESSION['email'])) : ?>
    <a href="index.php?logout='1'" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Logout</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><?php echo $row['username'] ?></a>
    <?php endif ?>
    <!-- <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a> -->
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#band" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">Groups</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">ALBUM</a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTACT</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">MERCH</a>
</div>
    <div class="header">
  	    <h2>Write Comment</h2>
    </div>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
        <!-- <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>" > -->
        <div class="input-group">
  	        <label>Comment:</label>
  	        <textarea name="body" rows="5" cols="49"><?php echo $comment['body'];?></textarea>
  	    </div>
        <div class="input-group">
  	        <button type="submit" class="btn" name="edit_cmt">Update</button>
  	    </div>
    </form>
</body>
</html>