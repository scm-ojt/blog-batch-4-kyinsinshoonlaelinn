<?php include('../common/nav.php');
    include('server.php');
    require('../common/config.php'); 
    $result = mysqli_query($conn,"SELECT * FROM posts WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
    $cresult = $conn->query("SELECT category_id FROM category_post WHERE post_id='".$_GET['id']."'");
    $cateList = [];
    $cateList = $cresult->fetch_all();
    if (isset($_POST['edit_post'])) {
  
      $target_dir = "../img/posts";
                        $fileExt = explode('.',$_FILES['image']['name']);
                        $fileActualExt = strtolower(end($fileExt));
                        $image =  $target_dir. "/".uniqid(rand(), true).".".$fileActualExt;
                        move_uploaded_file($_FILES['image']['tmp_name'], $image);
      
    
      if(isset($_POST['categoryList'])) {
       $categoryList = $_POST['categoryList'];
      }
      $title = mysqli_real_escape_string($db, $_POST['title']);
      $body = mysqli_real_escape_string($db, $_POST['body']);
    
      // form validation: ensure that the form is correctly filled ...
      if (empty($categoryList)) { 
        array_push($errors, "At least one category is required");  
      }
      if (empty($title)) { 
        array_push($errors, "Title is required");  
      }
      if (empty($body)) { 
        array_push($errors, "Description is required");   
      }
     
      if (count($errors) == 0) {
        $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
        $updated_date = $dt->format('Y.m.d , h:i:s');
        if(empty($_FILES['image']["name"])) {
          $query = "UPDATE posts SET title='".$_POST['title']."', body='".$_POST['body']."', updated_date='".$updated_date."' WHERE id='".$_POST['id']."' ";
          mysqli_query($db, $query);
        }
        else { 
          $result = mysqli_query($db,"SELECT * FROM posts WHERE id='" . $_POST['id'] . "'");
          $row= mysqli_fetch_array($result);
    
          $query = "UPDATE posts SET image='".$image."', title='".$_POST['title']."', body='".$_POST['body']."', updated_date='".$updated_date."' WHERE id='".$_POST['id']."' ";
          mysqli_query($db, $query);
          unlink($row['image']);
        }
      
        $cresult = $db->query("SELECT category_id FROM category_post WHERE post_id='".$_POST['id']."'");
        $cateList = [];
        $cateList = $cresult->fetch_all();
        
          $query = "DELETE FROM category_post where post_id='".$_POST['id']."'";
          mysqli_query($db, $query);
          $pid = $_POST['id'];
          print_r($pid);
        foreach($_POST['categoryList'] as $cid) {
          $uquery = "INSERT INTO category_post (post_id,category_id) VALUES ('$pid','$cid')";
          mysqli_query($db, $uquery);
        }
        
      }
      header('location: ../posts/post.php');
    }
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
	
  <form method="post" action="edit.php?id=<?php echo $row['id']?>" enctype="multipart/form-data">
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
  	  <input type="file" name="image" accept="image/png, image/gif, image/jpeg" value="<?php echo $row['image']; ?>" >
  	</div>
  	<div class="input-group">
  	  <label>Title:</label>
  	  <input type="test" name="title" value="<?php echo $row['title']; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description:</label>
  	  <textarea name="body" rows="5" cols="33"><?php echo $row['body'];?></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_post">Update</button>
  	</div>
  </form>
</body>
</html>