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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: lightgray;
    }
    .img-size {
        width: 500px;
        height: 400px;
        margin-left: 14%;
    }
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
    .left {
      width: 72%;
      float: left;
      border-right: solid 1px lightgray;
    }
    .detail {
      background-color: #fff;
      margin-top:130px;
      box-shadow: 0px 0px 10px 0px grey;
      padding: 25px 0px;
    }
    .detail-inner {
      width: 1062px;
      margin: 0 auto;
    }
    .right {
      float: left;
      width: 28%;
    }
    .fawesome {
      margin-right: 7px;
    }
    .comment {
      margin-left: 11px;
    }
    .cmt-user {
      color:#00008b;
    }
    .comment-write {
      width: 85%;     
      color: gray;
    }
    .create-cmt a {
      color: #000;
      text-decoration: underline;
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
</script>
</head>
<body>
  <div class="inner-div">
    <div class="detail clearfix">
      <div class="detail-inner">
        <div class="left">
    <h3 style="color: #00008b"><i class='fas fa-user' style='font-size:20px'></i> <?php echo $arr_user['username']; ?> </h3>
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
    </div>
    <div class="right">
    <div class="comment">
    <?php if (isset($_SESSION['email'])) { ?>
    <div class="create-cmt"><a href="../comment/create.php?post_id=<?php echo $arr_categories['id']; ?>"> Write Comment </a></div>
    <?php } else { ?>
      <a href="../registration/login.php"> Write Comment </a>
    <?php } ?>
    
        <?php
        foreach($comments as $cmt) { 
          $cuquery  = "SELECT * FROM users WHERE id ='".$cmt[2]."'";
          $curesult = mysqli_query($conn, $cuquery);
          $cuser = mysqli_fetch_assoc($curesult);
        ?>
        <div class="cmt-user" ><i class='fas fa-user fawesome'></i><?php echo $cuser['username']; ?> </div>
        <div class="clearfix">
          <div class="comment-write">
            <?php echo $cmt[3]; ?> 
          </div>
          <div class="action">
            <?php if (isset($_SESSION['email'])) {
              if($row['id'] == $cmt[2]) { ?>
            <a class="btn-xs btn-info" href="../comment/edit.php?id=<?php echo $cmt[0]; ?>&user_id=<?php echo $cmt[2]; ?>"> Edit <i class="fa fa-edit"></i> </a> &nbsp; &nbsp;
            <a class="btn-xs btn-danger" href="javascript:delete_id(<?php echo $cmt[0]; ?>)">Delete <i class="fa fa-trash"></i></a> <br><br> 
            </div>
          <?php } }?>
        </div> 
        <?php } 
        ?>   
    </div>
        </div>
        </div>
      </div>
  </div>
</body>
</html>