<?php include('../common/nav.php');
    require_once('../common/config.php');
    $query = "SELECT * FROM posts";
    $result = $conn->query($query);
    $arr_categories = [];
    if ($result->num_rows > 0) {
      $arr_categories = $result->fetch_all(MYSQLI_ASSOC);
    }
    $cquery = "SELECT * FROM comments WHERE posts_id ='".$_GET['id']."'";
    $cresult = mysqli_query($conn, $cquery);
    $comments = [];
    $comments = mysqli_fetch_all($cresult);
?>
<!DOCTYPE html>
<html>
<head>
    <title>POST LIST</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    
<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='delete.php?id='+id;
     }
}
</script>
<style>
    .img-size {
        width: 200px;
        height: 200px;
    }
</style>
</head>

<body>
  <div style="margin-top:62px; display:block"></div>
<table id="Ptb">
    <thead>
        <th>ID</th>
        <th>Category</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created Date </th>
        <th>Updated Date </th>
        <th>Action </th>
    </thead>
    <tbody>
        <?php if(!empty($arr_categories)) { ?>
            <?php foreach($arr_categories as $cate) { ?>
                <tr>
                    <td><?php echo $cate['id']; ?></td>
                    <td>
                    <?php 
                    require('../common/config.php');
                    $cquery = "SELECT DISTINCT category_id FROM category_post where post_id = '".$cate['id']."' ";
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
                    <?php echo $cname; ?>
                    <?php } } ?></td>
                    <td><img class="img-size" src="<?php echo $cate['image']; ?>"></td>
                    <td><?php echo $cate['title']; ?></td>
                    <td><?php echo $cate['body']; ?></td>
                    <td><?php echo $cate['created_date']; ?></td>
                    <td><?php echo $cate['updated_date']; ?></td>
                    <td><a href="edit.php?id=<?php echo $cate['id']; ?>" > Edit </a> &nbsp; &nbsp;
                    <a href="javascript:delete_id(<?php echo $cate['id']; ?>)">Delete</a> &nbsp; &nbsp;
                    <a href="detail.php?id=<?php echo $cate['id']; ?>"> Details </a> </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#Ptb').DataTable();
} );
</script>