<?php
session_start();

// initializing variables
$category_name = "";
$dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
$created_at = $dt->format('Y.m.d , h:i:s');
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'blog');

// REGISTER category
if (isset($_POST['reg_category'])) {
  // receive all input values from the form
  $category_name = mysqli_real_escape_string($db, $_POST['category_name']);

  // form validation: ensure that the form is correctly filled ...
  if (empty($category_name)) { 
    array_push($errors, "Category name is required");  
  }

  // a category does not already exist with the same category
  $check_query = "SELECT * FROM categories WHERE category_name='$category_name' LIMIT 1";
  $result = mysqli_query($db, $check_query);
  $category = mysqli_fetch_assoc($result);
  
  if ($category) { // if category exists
    if ($category['category_name'] === $category_name) {
      array_push($errors, "Category name already exists");
    }
  }

  //register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO categories (category_name, created_date) 
  			  VALUES('$category_name', '$created_at')";
  	mysqli_query($db, $query);
  	header('location: ../registration/index.php');
  }
}