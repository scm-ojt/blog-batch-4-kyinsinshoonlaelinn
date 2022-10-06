<?php 
include('server.php');
include('../common/nav.php');
include('../category/fetch_category.php') 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Create</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
  <link rel="stylesheet" type="text/css" href="../css/example-styles.css">
  <link rel="stylesheet" type="text/css" href="../css/demo-styles.css">

  
</head>
<body>
  <div class="header">
  	<h2>Post Create</h2>
  </div>
	
  <form method="post" action="create.php" enctype="multipart/form-data">
    <?php include('../common/errors.php'); ?>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <select id="categories" name="categoryList[]" multiple placeholder= 'Category'>
        
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
  	  <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
  	</div>
  	<div class="input-group">
  	  <label>Title:</label>
  	  <input type="test" name="title" value="<?php echo $title; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description:</label>
  	  <textarea name="body" rows="5" cols="33"><?php echo $body;?></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_post">Submit</button>
  	</div>
  </form>
  <script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="../js/jquery.multi-select.js"></script>
    <script type="text/javascript">
    $(function(){
        $('#categories').multiSelect();
    });
    </script>

</body>
</html>
