<?php 
    $query ="SELECT category_name FROM categories";
    $result = $db->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>