<?php
include_once('database.php');

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$rowsPerPage = 10;
$perRow = $page * $rowsPerPage - $rowsPerPage;
$sql = "SELECT * FROM category LIMIT $perRow, $rowsPerPage";
$query = mysqli_query($conn, $sql);

$listPage = '';
?>
<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<h2>Danh mục sản phẩm</h2>
<div id="main">
    <p id="add-prd">
        <a href="themldh.php"><span>Thêm loại đồng hồ mới</span></a>
    </p>

    <table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="10%">Tên sản phẩm</td>
            <td width="15%">Ảnh mô tả</td>
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
        </tr>
        <?php
        while($row = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td class="l10"><?php echo $row['category_name']?></td>
            <td><span class="thumb"><img width="60" src="image/<?php echo $row['images'];?>" /></span></td>
            <td><a href="sualdh.php?category_id=<?php echo $row['category_id']; ?>">Sửa</a></td>
            <td><button onclick="deleteCategory(<?php echo $row['category_id']; ?>)">Xóa</button></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <?php
       $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM category"));
       $totalPage = ceil($totalRows/$rowsPerPage);
       for($i=1;$i<=$totalPage;$i++){
            if($i==$page){
                $listPage .= " <span>".$i."</span> ";
            }else{
                $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=danhmucsp&page='.$i.'">'.$i.'</a> ';
            }
       }
    ?>
    <p id="pagination"><?php echo $listPage;?></p>
</div>

<script>
    function deleteCategory(categoryId) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            window.location.href = 'xoaldh.php?category_id=' + categoryId;
        }
    }
</script>
