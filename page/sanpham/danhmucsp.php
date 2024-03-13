<link rel="stylesheet" href="../page/css/danhmucsp.css">
<?php
// Include the database connection
include_once('database.php');
// Lấy category_id từ URL
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// Kiểm tra nếu không có category_id được chọn
if ($category_id === null) {
    // Hiển thị tất cả các danh mục
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Các loại đồng hồ</h2>
        </div>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-1 ">
                <div class="card">
                    <a href="index.php?page_layout=danhsachsp&category_id=<?php echo $row['category_id'] ?>&category_name=<?php echo $row['category_name'] ?>">
                        <img class="card-img-top prd-image " src="../page/sanpham/image/<?php echo $row['images'] ?>" alt="<?php echo $row['category_name'] ?>" style="width: 250px; height: 200px;   ">
                    </a>
                    <div class="card-body   ">
                        <h5 class="card-title" style="font-size: 14px; ">
                            <a href="index.php?page_layout=danhsachsp&category_id=<?php echo $row['category_id'] ?>&category_name=<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></a>
                        </h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>




<?php
} else {
    // Hiển thị sản phẩm thuộc category_id được chọn
    $sql = "SELECT * FROM product WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Products</h2>
        </div>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="card">
                    <a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>">
                        <img class="card-img-top prd-image" src="../page/sanpham/image/<?php echo $row['images'] ?>" alt="<?php echo $row['name'] ?>" style="width: 100%; max-height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 14px;">
                            <a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                        </h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
}
?>
