<?php include('../common/nav.php');
    require_once('../common/config.php');
    $query = "SELECT * FROM posts";
    $result = $conn->query($query);
    $arr_categories = [];
    if ($result->num_rows > 0) {
      $arr_categories = $result->fetch_all(MYSQLI_ASSOC);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>POST LIST</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    
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
        width: 70px;
        height: 70px;
    }
    .cate-btn {
        border-radius: 25%;
        background-color: grey;
        color: #fff;
    }
    table.dataTable.table-striped tr.even {
    background-color: lightgray !important;
}
 
.table-striped > tbody > tr:nth-of-type(odd) {
  --bs-table-accent-bg: none !important;
}
</style>
</head>

<body>
  <div class="inner-div">
    <div class="gap"></div>
  <?php if (isset($_SESSION['email'])) { ?>
    <button style="margin-top:36px; background-color: lightgray;"><i class="fa fa-plus-circle"></i><a style="text-decoration:none" href="../posts/create.php"> Add Post </a></button><br><br>
  <?php } ?>
<table id="Ptb" class="table-striped">
    <thead>
        <th>ID</th>
        <th>Category</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Description</th>
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
                        echo '<button class="cate-btn">';
                        $sql = "SELECT category_name FROM categories where id = '".$cid[0]."' ";
                        $cname_result = $conn->query($sql);
                        $arr_cname = [];
                        if ($cname_result->num_rows > 0) {
                            $arr_cname = $cname_result->fetch_assoc();
                          }
                        
                        foreach($arr_cname as $cname) {
                            
                    ?>
                    <?php echo $cname; ?>
                    <?php } echo '</button>'; } ?></td>
                    <td><img class="img-size" src="<?php echo $cate['image']; ?>"></td>
                    <td><?php echo $cate['title']; ?></td>
                    <td><?php echo $cate['body']; ?></td>
                    <td>
                    <a href="detail.php?id=<?php echo $cate['id']; ?>"> <i class="fa fa-external-link" style="font-size:24px"></i></a> &nbsp; &nbsp;
                    <?php if (isset($_SESSION['email'])) { 
                        if($row['id'] == $cate['users_id']) { ?>
                    <a href="edit.php?id=<?php echo $cate['id']; $_SESSION['post_id'] = $cate['id'] ?>" > <i class="fa fa-edit" style="font-size:24px"></i></a> &nbsp; &nbsp;
                    <a href="javascript:delete_id(<?php echo $cate['id']; ?>)"> <i class="fa fa-trash-o" style="font-size:25px;color:red"></i></a> 
                    <?php } }?>
                     </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
$(document).ready(function () {
    $('#Ptb').DataTable({
        order: [[0, 'desc']],
    });
});
</script>