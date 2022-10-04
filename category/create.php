<?php include('../common/nav.php');
include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Category Registration</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
  <div class="header">
  	<h2>Category Registeration</h2>
  </div>
	
  <form method="post" action="category_register.php">
  	<?php include('../common/errors.php'); ?>
  	<div class="input-group">
  	  <label>Category Name</label>
  	  <input type="text" name="category_name" value="<?php echo $category_name; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_category">Submit</button>
  	</div>
  </form>
</body>
</html>