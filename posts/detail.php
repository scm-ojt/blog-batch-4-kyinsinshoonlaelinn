<?php 
include('../common/nav.php');
require('../common/config.php'); 
if(isset($_GET['id']))
{
    $query = "SELECT * FROM posts WHERE id ='".$_GET['id']."'";
    $result = mysqli_query($conn, $query);
    $arr_categories = mysqli_fetch_assoc($result);

    $uquery = "SELECT * FROM users WHERE id ='".$arr_categories['users_id']."'";
    $uresult = mysqli_query($conn, $uquery);
    $arr_user = mysqli_fetch_assoc($uresult);

    $cquery = "SELECT * FROM comments WHERE posts_id ='".$_GET['id']."'";
    $cresult = mysqli_query($conn, $cquery);
    $comments = [];
    $comments = mysqli_fetch_all($cresult);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Post Details</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <style>
    .img-size {
        width: 500px;
        height: 400px;
        margin-left: 26%;
    }
    </style>
    <script>
        function delete_id(id)
        {
            if(confirm('Sure To Remove This Record ?'))
            {
                window.location.href='../comment/delete.php?id='+id;
            }
        }
        $(document).ready(function(){
          $("#myBtn").hover(function(){
            $(this).disabled = true;
          });
        });
</script>
</head>
<body>
  <div class="inner-div">
    <h3 style="margin-top:64px;"><i class='fas fa-user-check' style='font-size:20px'></i> <?php echo $arr_user['username']; ?> </h3>
    <h1> <?php  echo $arr_categories['title']; ?> </h1>
    <ul>
            <?php 
                    require('../common/config.php');
                    $cquery = "SELECT DISTINCT category_id FROM category_post where post_id = '".$arr_categories['id']."' ";
                    $cresult = $conn->query($cquery);
                    $arr_cid= [];
                    $i = 0;
                    if ($cresult->num_rows > 0) {
                        $arr_cid = $cresult->fetch_all();
                      }
                    // $arr_cid[] = array_unique($arr_cid);
                    foreach($arr_cid as $cid) {
                        
                        $sql = "SELECT category_name FROM categories where id = '".$cid[0]."' ";
                        $cname_result = $conn->query($sql);
                        $arr_cname = [];
                        if ($cname_result->num_rows > 0) {
                            $arr_cname = $cname_result->fetch_assoc();
                          }
                        
                        foreach($arr_cname as $cname) {
                            
                ?>
                <li> <?php echo $cname; ?> </li>
                <?php } } ?>         
    </ul>
    <img class="img-size" src="<?php echo $arr_categories['image']; ?>">
    <br><br>
    <div> <?php echo $arr_categories['body']; ?> </div>
    <br>
    <?php if (isset($_SESSION['email'])) { ?>
    <a href="../comment/create.php?post_id=<?php echo $arr_categories['id']; ?>"> Write Comment </a>
    <?php } else { ?>
      <a href="../registration/login.php"> Write Comment </a>
    <?php } ?>
    <table>
        <thead>
        <th> Comments </th>
        <th>  </th>
        </thead>
        <?php
        foreach($comments as $cmt) { ?>
        <tbody>
            <td><?php echo $cmt[3] ; ?> </td> 
            <?php if (isset($_SESSION['email'])) {
              if($row['id'] == $cmt[2]) { ?>
            <td><a href="../comment/edit.php?id=<?php echo $cmt[0]; ?>&user_id=<?php echo $cmt[2]; ?>"> Edit </a> &nbsp; &nbsp;
            <a href="javascript:delete_id(<?php echo $cmt[0]; ?>)">Delete</a> </td>
        <?php } }?>
        </tbody>
        <?php } 
        ?>   
    </table>
  </div>
</body>
</html>