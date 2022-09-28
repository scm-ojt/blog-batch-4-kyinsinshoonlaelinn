<?php
session_start();

// initializing variables
$categoryList = [];
$image = "";
$title    = "";
$body = "";
$dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
$created_at = $dt->format('Y.m.d , h:i:s');
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'blog');

// REGISTER POST
if (isset($_POST['reg_post'])) {
  // receive all input values from the form
  foreach ($_GET['categoryList'] as $value) {
    $categoryList.= $value.", ";
  }
  $target_dir = "../img/posts";
                    $fileExt = explode('.',$_FILES['image']['name']);
                    $fileActualExt = strtolower(end($fileExt));
                    $image =  $target_dir. "/".uniqid(rand(), true).".".$fileActualExt;
                    move_uploaded_file($_FILES['image']['tmp_name'], $image);
  /* $filename = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];
  $folder = "../img/posts/". $filename ; */
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $body = mysqli_real_escape_string($db, $_POST['body']);

  // form validation: ensure that the form is correctly filled ...
  if (empty($title)) { 
    array_push($errors, "Title is required");  
  }
  if (empty($body)) { 
    array_push($errors, "Description is required");   
  }
  foreach ($categoryList as $category) {
    echo $category;
  }
 /*  move_uploaded_file($tempname, $folder);
  if (move_uploaded_file($filename, $folder)) {
    echo "<h3>  Image uploaded successfully!</h3>";
  } else {
    echo "<h3>  Failed to upload image!</h3>";
  } */

  /* // an image does not already exist with the same name
  $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  } */

  //register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO posts (image, title, body, created_date) 
  			  VALUES('$image', '$title', '$body', '$created_at')";
  	mysqli_query($db, $query);
    header('location: ../registration/index.php');
  }
}
  
?>