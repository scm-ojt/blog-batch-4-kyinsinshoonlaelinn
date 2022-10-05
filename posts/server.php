<?php
session_start();

// initializing variables
$id = "";
$categoryList = [];
$image = "";
$title    = "";
$body = "";
$dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
$created_at = $dt->format('Y.m.d , h:i:s');
$errors = []; 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'blog');

// REGISTER POST
if (isset($_POST['reg_post'])) {
  // receive all input values from the form
  /* foreach ($_GET['categoryList'] as $value) {
    $categoryList.= $value.", ";
  } */

  $target_dir = "../img/posts";
                    $fileExt = explode('.',$_FILES['image']['name']);
                    $fileActualExt = strtolower(end($fileExt));
                    $image =  $target_dir. "/".uniqid(rand(), true).".".$fileActualExt;
                    move_uploaded_file($_FILES['image']['tmp_name'], $image);
  
  /* $filename = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];
  $folder = "../img/posts/". $filename ; */
  if(isset($_POST['categoryList'])) {
   $categoryList = $_POST['categoryList'];
  }
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $body = mysqli_real_escape_string($db, $_POST['body']);
  $id = $_POST['id'];
  print_r($id);

  // form validation: ensure that the form is correctly filled ...
  if (empty($categoryList)) { 
    array_push($errors, "At least one category is required");  
  }
  if(empty($_FILES['image']["name"])) {
    array_push($errors, "Photo is required");  
  }
  if (empty($title)) { 
    array_push($errors, "Title is required");  
  }
  if (empty($body)) { 
    array_push($errors, "Description is required");   
  }
 /*  move_uploaded_file($tempname, $folder);
  if (move_uploaded_file($filename, $folder)) {
    echo "<h3>  Image uploaded successfully!</h3>";
  } else {
    echo "<h3>  Failed to upload image!</h3>";
  } */

  //register user if there are no errors in the form
  if (count($errors) == 0) {
    $query = "INSERT INTO posts (image, title, body, created_date, users_id) 
  			  VALUES('$image', '$title', '$body', '$created_at', '$id')";
  	mysqli_query($db, $query);
    foreach ($categoryList as $cid) {
        $ss = "select last_insert_id() from posts";
        $query = mysqli_query($db,$ss);
        $post_row = mysqli_fetch_assoc($query);
        $pid = $post_row['last_insert_id()'];
        $sql = "INSERT INTO category_post (post_id,category_id) VALUES ('$pid','$cid')";
        if(mysqli_query($db,$sql)){
                // header("location:create.php");
                echo "<p>category_post success</p>";
            }else{
                echo "Query Fail : ".mysqli_error($conn);
            }
        }
      header('location: ../posts/post.php');
  }
}

?>