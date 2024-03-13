<?php
    include_once('database.php');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rowsPerPage = 10;
    $perRow = $page * $rowsPerPage - $rowsPerPage;
    $sql = "SELECT * FROM product LIMIT $perRow, $rowsPerPage";
    $query = mysqli_query($conn, $sql);

    $listPage = '';
?>
<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<h2>Quản lý sản phẩm</h2>
<div id="main">
    <p id="add-prd">
        <a href="admin.php?page_layout=them"><span>Thêm sản phẩm mới</span></a>
    </p>
    <table id="prds" border="0" cellpadding="0" cellspacing="0" width="200%">
        <tr id="prd-bar">
            <td width="10%">Tên sản phẩm</td>
            <td width="10%">Giá</td>
            <td width="10%">Size</td>
            <td width="10%">Glass Material</td>
            <td width="10%">Color</td>
            <td width="10%">Specs</td>
            <td width="10%">Warranty</td>
            <td width="10%">Strap Type</td>
            <td width="10%">Category ID</td>
            <td width="15%">Ảnh mô tả</td>
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
        </tr>
        <?php
        while($row = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td class="l10"><a href="#"><?php echo $row['name'];?></a></td>
            <td class="l10"><span class="price"><?php echo $row['price'];?></span></td>
            <td class="l10"><?php echo $row['size']?></td>
            <td class="l10"><?php echo $row['glass_material']?></td>
            <td class="l10"><?php echo $row['color']?></td>
            <td class="l10"><?php echo strlen($row['specs']) > 20 ? substr($row['specs'], 0, 20) . "..." : $row['specs']; ?></td>
            <td class="l10"><?php echo strlen($row['warranty']) > 20 ? substr($row['warranty'], 0, 20) . "..." : $row['warranty']; ?></td>
            <td class="l10"><?php echo $row['strap_type']?></td>
            <td class="l10"><?php echo $row['category_id']?></td>
            <td><span class="thumb"><img width="60" src="image/<?php echo $row['images'];?>" /></span></td>
            <td><a href="sua.php?produc_id=<?php echo $row['id']; ?>">Sửa</a></td>
            <td><button onclick="deleteProduct(<?php echo $row['id']; ?>)">Xóa</button></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <?php
       $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product"));
       $totalPage = ceil($totalRows/$rowsPerPage);
       for($i=1;$i<=$totalPage;$i++){
            if($i==$page){
                $listPage .= " <span>".$i."</span> ";
            }else{
                $listPage .= ' <a href="'.$_SERVER['PHP_SELF'].'?page_layout=danhsachsp&page='.$i.'">'.$i.'</a> ';
            }
       }
    ?>
    <p id="pagination"><?php echo $listPage;?></p>
</div>

<script>
    function deleteProduct(productId) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            window.location.href = 'xoa.php?produc_id=' + productId;
        }
    }
</script>
<?php
    if(isset($_POST['submit'])){
        // Xử lý khi nhấn nút Cập nhật
        // Code xử lý cập nhật dữ liệu vào cơ sở dữ liệu

        // Sau khi cập nhật thành công, chuyển hướng trở lại trang danh sách sản phẩm và hiển thị thông báo thành công
        header('location: admin.php?page_layout=danhsachsp&success=true');
        exit(); // Đảm bảo không có mã HTML hoặc văn bản khác được xuất ra sau hàm header
    }
?>
