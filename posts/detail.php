<?php
require('../common/config.php'); 
if(isset($_GET['id']))
{
    $query = "SELECT * FROM posts WHERE id ='".$_GET['id']."'";
    $result = mysqli_query($conn, $query);
    $arr_categories = mysqli_fetch_assoc($result);
    
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
  <!-- <link rel="stylesheet" type="text/css" href="../css/register.css"> -->
  <style>
    .img-size {
        width: 500px;
        height: 400px;
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
    <a href="../comment/create.php?post_id=<?php echo $arr_categories['id']; ?>"> Write Comment </a>
    <table>
        <thead>
        <th> Comments </th>
        <th> Actions </th>
        </thead>
        
        <?php
        foreach($comments as $cmt) { ?>
        <tbody>
            <td><?php echo $cmt[3] ; ?> </td>
            <td><a href="../comment/edit.php?id=<?php echo $cmt[0]; ?>"> Edit </a> &nbsp; &nbsp;
            <a href="javascript:delete_id(<?php echo $cmt[0]; ?>)">Delete</a> </td>
        </tbody>
        <?php }
        ?>
        
    </table>   

</body>
</html>