<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title> Login </title>
    
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
<div class=""> 
   <div class="header">
      <h2>Login</h2>
   </div>
   <form method="POST" action="login.php" class="form-signin">     
      <?php include('../common/errors.php'); ?>
      <div class="input-group">
         <input type="text" name="email" placeholder="Enter Your Email" required="" autofocus="" value="<?php echo $email; ?>"/>
      </div>
      <div class="input-group">
         <input type="password" name="password" placeholder="Enter Password" required=""/>  
      </div>
      <div class="input-group">    
         <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user">Login</button>
      </div>
      <p>
  		Don't have an account? <a href="register.php">Sign Up</a>
  	   </p>   
   </form>
</div>

</body>
</html>