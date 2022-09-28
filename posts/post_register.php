<?php include('server.php') ?>
<?php include('../categories/fetch_category.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Create</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
  <div class="header">
  	<h2>Post Create</h2>
  </div>
	
  <form method="post" action="post_register.php" enctype="multipart/form-data">
    <?php include('../common/errors.php'); ?>
    <select name="categoryList" multiple="multiple">
        <option>Categories</option>
        <?php 
        foreach ($options as $option) {
        ?>
        <option><?php echo $option['category_name']; ?> </option>
        <?php 
    }
   ?>
 </select>
    <br><br>
  	<div class="">
  	  <label>Image Upload:</label>
  	  <input type="file" name="image" value="<?php echo $image; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Title:</label>
  	  <input type="test" name="title" value="<?php echo $title; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description:</label>
  	  <textarea name="body" rows="5" cols="39"><?php echo $body;?></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_post">Submit</button>
  	</div>
  </form>
</body>
</html>