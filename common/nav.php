<?php 
  require('../common/config.php'); 
  session_start();
  
  if (!isset($_SESSION['email'])) {
  	//header('location: ../posts/post.php');
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
<head>
	<title>Home</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
      $(document).ready(function(){
        $("a").click(function() {
          // remove classes from all
          $("a").removeClass("active");
          // add class to the one we clicked
          $(this).addClass("active");
        });
      });
    </script>
    <style>
      .active {
        background-color: grey;
      }
      .custom-button {
        width: 80px;
      }
      .nav-black {
        color: #fff;
        background-color: grey;
      }
      img {
        width: 68px;
        height: 62px;
      }
      .margin {
        margin-top: 15px;
      }
      .w3-bar-item-custom {
        padding: 8px 1px;
        float: left;
        width: auto;
        border: none;
        display: block;
        outline: 0;
      }
    </style>
</head>
<body>

<div class="">
    <!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar nav-black w3-card">
    <div class="inner-div">
    <a href="../posts/post.php" class="w3-bar-item-custom"><img src="../img/logo3.png" alt="logo"></a>
    <a href="../category/category.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small margin">CATEGORY</a>
    <a href="../posts/post.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small margin">POST LIST</a>
    <?php  if (isset($_SESSION['email'])) { ?>
      <div class="w3-dropdown-hover w3-hide-small">
        <button class="w3-padding-large w3-button margin" title="More"><?php echo $row['username'] ?> <i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="../registration/index.php?logout='1'" class="w3-bar-item w3-button">LogOut</a>
        </div>
      </div>
    <?php } else {?>
      <a href="../registration/login.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small margin">LOGIN</a>
    <?php } ?>
    </div>
  </div>
</div>

</div>
</body>
</html>