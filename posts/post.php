<?php 
    require_once('../common/config.php');
    $query = "SELECT * FROM posts";
    $result = $conn->query($query);
    $arr_categories = [];
    if ($result->num_rows > 0) {
      $arr_categories = $result->fetch_all(MYSQLI_ASSOC);
    }
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
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
                    <!-- <?php 
                    require('../common/config.php');
                    $cquery = "SELECT category_id FROM category_post where post_id = '".$cate['id']."' ";
                    $cresult = mysqli_query($conn, $cquery);
                    $arr_cid= mysqli_fetch_array($cresult);
                    foreach($arr_cid as $cid) {
                        $sql = "SELECT category_name FROM categories where id = '".$cid."' ";
                        $cname_result = mysqli_query($conn, $cname_result);
                        $arr_cname = mysqli_fetch_array($cname_result);
                        foreach($arr_cname as $cname) {
                    ?>
                    <td><?php echo $cname; ?></td>
                    <?php } } ?> -->
                    <td><?php echo ""; ?></td>
                    <td><?php echo $cate['title']; ?></td>
                    <td><?php echo $cate['body']; ?></td>
                    <td><?php echo $cate['created_date']; ?></td>
                    <td><?php echo $cate['updated_date']; ?></td>
                    <td><a href="" > Edit </a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#Ptb').DataTable();
} );
</script>