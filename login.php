<?php
$host = "localhost";
$user = "root";
$password= "root";
$db = "blog";
$connect = mysqli_connect($host, $user, $password, $db);
if(isset($_POST['username'])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "select * from loginform where username = '".$uname."'AND password = '".$pass."' limit 1";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result) == 1) {
        echo "You have successfully logged in";
        exit();
    }
    else {
        echo "You have entered an incorrect password or username";
        exit();
    }
}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="wrapper"> 
   <form method="POST" action="#" class="form-signin">
      <h2 class="form-signin-heading">Please Login</h2>
      <input type="text" class="form-control" name="username" placeholder="Enter Username" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Enter Password" required=""/>      
      <label class="checkbox">
      <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
   </form>
</div>
<?php
echo "My first PHP script!";
?>

</body>
</html>