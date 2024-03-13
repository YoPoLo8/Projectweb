<link rel="stylesheet" href="../page/css/danhsachsp.css">
<?php
// Include the database connection
include_once('database.php');

// Lấy category_id từ URL
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// Kiểm tra nếu không có category_id được chọn
if ($category_id === null) {
    // Hiển thị tất cả sản phẩm
    $sql = "SELECT * FROM product";
} else {
    // Hiển thị sản phẩm thuộc category_id được chọn
    $sql = "SELECT * FROM product WHERE category_id = $category_id";
}

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
                        <img class="card-img-top prd-image" src="../page/sanpham/image/<?php echo $row['images'] ?>" alt="<?php echo $row['name'] ?>" style="width: 100%; height: 114px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 14px;">
                            <a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                        </h5>
                        <p class="card-text" style="font-size: 14px;">Size: <?php echo $row['size'] ?></p>
                        <p class="card-text" style="font-size: 14px;">Glass Material: <?php echo $row['glass_material'] ?></p>
                        <p class="card-text" style="font-size: 14px;">Price: <?php echo $row['price'] ?> USD</p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>




