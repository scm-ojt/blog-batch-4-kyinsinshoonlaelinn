<?php include('../common/nav.php');
include('server.php');
include('../category/fetch_category.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Create</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="multiselect/jquery.multiselect.js"></script>
  <link rel="stylesheet" href="multiselect/jquery.multiselect.css">
  <script>
    $('#langOpt').multiselect({
    columns: 1,
    placeholder: 'Category',
    search: true,
    });
  </script>
</head>
<body>
  <div class="header">
  	<h2>Post Create</h2>
  </div>
	
  <form method="post" action="create.php" enctype="multipart/form-data">
    <?php include('../common/errors.php'); ?>
    <select name="categoryList[]" multiple id="langOpt" placeholder= 'Category'>
        <option disabled selected> Category </option>
        <?php 
        foreach ($options as $option) {
        ?>
        <option value="<?php echo $option['id']; ?>"><?php echo $option['category_name']; ?> </option>
        <?php 
    }
   ?>
 </select>
    <br><br>
  	<div class="">
  	  <label>Image Upload:</label>
  	  <input type="file" name="image">
  	</div>
  	<div class="input-group">
  	  <label>Title:</label>
  	  <input type="test" name="title" value="<?php echo $title; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description:</label>
  	  <textarea name="body" rows="5" cols="32"><?php echo $body;?></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_post">Submit</button>
  	</div>
  </form>
</body>
</html>