<?php include('../common/nav.php');
    include('server.php');
    require_once('../common/config.php'); 
    $result = mysqli_query($conn,"SELECT * FROM categories WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Category Update</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
  <div class="header">
  	<h2>Update Category</h2>
  </div>
	
  <form method="post" action="edit.php">
  	<?php include('../common/errors.php'); ?>
    
  	<div class="input-group">
  	  <label>Category Name</label>
  	  <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_category">Update</button>
  	</div>
  </form>
</body>
</html>