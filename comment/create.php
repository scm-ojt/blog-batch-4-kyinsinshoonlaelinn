<?php include('../common/nav.php');
include('server.php');
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
<head>
  <title>Post Details</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="multiselect/jquery.multiselect.js"></script>
</head>
<body>
    <div class="header">
  	    <h2>Write Comment</h2>
    </div>
    <form method="post" action="create.php?post_id=<?php echo $_GET['post_id']?>">
        <?php include('../common/errors.php'); ?>
        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>" >
        <div class="input-group">
  	        <label>Comment:</label>
  	        <textarea name="body" rows="5" cols="37"><?php echo $body;?></textarea>
  	    </div>
        <div class="input-group">
  	        <button type="submit" class="btn" name="reg_cmt">Submit</button>
  	    </div>
    </form>
</body>
</html>