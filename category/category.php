<?php include('../common/nav.php');
    require_once('../common/config.php');
    $query = "SELECT * FROM categories";
    $result = $conn->query($query);
    $arr_categories = [];
    if ($result->num_rows > 0) {
      $arr_categories = $result->fetch_all(MYSQLI_ASSOC);
    }
?>
<head>
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
         table.dataTable.table-striped tr.even {
            background-color: lightgray !important;
        }
    </style>
</head>
<body>
    <div class="inner-div">
    <button style="margin-top:60px; background-color: lightgray;"><i class="fa fa-plus-circle"></i><a style="text-decoration:none" href="../category/create.php"> New Category </a></button> <br><br>
<table id="Ctb" class="table-striped">
    <thead>
        <th>ID</th>
        <th>Category Name</th>
        <th>Created Date </th>
        <th>Updated Date </th>
        <th>Action </th>
    </thead>
    <tbody>
        <?php if(!empty($arr_categories)) { ?>
            <?php foreach($arr_categories as $cate) { ?>
                <tr>
                    <td><?php echo $cate['id']; ?></td>
                    <td><?php echo $cate['category_name']; ?></td>
                    <td><?php echo $cate['created_date']; ?></td> 
                    <td><?php echo $cate['updated_date']; ?></td>
                    <td><a href="edit.php?id=<?php echo $cate['id']; ?>"?> <i class="fa fa-edit" style="font-size:24px"></i></a> &nbsp; &nbsp;
                    <a href="javascript:delete_id(<?php echo $cate['id']; ?>)"><i class="fa fa-trash-o" style="font-size:25px;color:red"></i></a></td>
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
    $('#Ctb').DataTable({
        order: [[0, 'desc']],
    });
});
</script>