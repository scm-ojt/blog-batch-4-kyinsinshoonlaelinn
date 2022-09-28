<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="wrapper"> 
   <form method="POST" action="login.php" class="form-signin">
      <h2 class="form-signin-heading">Please Login</h2>
      <?php include('../common/errors.php'); ?>
      <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required="" autofocus="" value="<?php echo $email; ?>"/>
      <input type="password" class="form-control" name="password" placeholder="Enter Password" required=""/>      
      <label class="checkbox">
      <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user">Login</button>   
   </form>
</div>

</body>
</html>