<?php 
    include('server.php');
    require('../common/config.php'); 
    $result = mysqli_query($conn,"SELECT * FROM posts WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
    $cresult = $conn->query("SELECT category_id FROM category_post WHERE post_id='".$_GET['id']."'");
    $cateList = [];
    $cateList = $cresult->fetch_all();
?>
<?php include('../category/fetch_category.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Post</title>
  <link rel="stylesheet" type="text/css" href="../css/register.css">
  <style>
    .img-size {
        width: 140px;
        height: 100px;
    }
</style>
</head>
<body>
<div class="header">
  	<h2>Post Edit</h2>
  </div>
	
  <form method="post" action="edit.php" enctype="multipart/form-data">
    <?php include('../common/errors.php'); ?>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <select name="categoryList[]" multiple id="langOpt" placeholder= 'Category'>
        <option disabled selected> Category </option>
        <?php 
        foreach ($options as $option) {
        ?> 
        <option value="<?php echo $option['id']; ?>" <?php foreach($cateList as $cList){ if($option['id'] == $cList[0]) { ?> selected <?php }} ?> > <?php echo $option['category_name']; ?> </option>
        <?php 
    }
   ?>
 </select>
    <br><br>
    <img class="img-size" src="<?php echo $row['image']; ?>">
  	<div class="">
  	  <label>Image Upload:</label>
  	  <input type="file" name="image">
  	</div>
  	<div class="input-group">
  	  <label>Title:</label>
  	  <input type="test" name="title" value="<?php echo $row['title']; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description:</label>
  	  <textarea name="body" rows="5" cols="39"><?php echo $row['body'];?></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_post">Update</button>
  	</div>
  </form>
</body>
</html>