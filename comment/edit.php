<?php include('../common/nav.php');
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
    <link rel="stylesheet" type="text/css" href="../css/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="multiselect/jquery.multiselect.js"></script>
</head>
<body>
    <div class="header">
  	    <h2>Edit Comment</h2>
    </div>
    <form method="post" action="edit.php?id=<?php echo $_GET['id']?>">
        <?php include('../common/errors.php'); ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
        <!-- <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>" > -->
        <div class="input-group">
  	        <label>Comment:</label>
  	        <textarea name="body" rows="5" cols="36"><?php echo $comment['body'];?></textarea>
  	    </div>
        <div class="input-group">
  	        <button type="submit" class="btn" name="edit_cmt">Update</button>
  	    </div>
    </form>
</body>
</html>