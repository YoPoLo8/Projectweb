<link rel="stylesheet" href="../page/css/chitietsp.css">
<?php
include_once('database.php');
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM product WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
?>

<div class="container mt-5">
    <h3 class="mb-4">Chi tiết sản phẩm</h3>
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src="../page/sanpham/image/<?php echo $row['images'] ?>" alt="<?php echo $row['name'] ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo $row['name'] ?></h2>
            <p class="price text-danger font-weight-bold"><?php echo number_format($row['price']); ?> USD</p>
            <p><strong>Kích thước:</strong> <?php echo $row['size'] ?></p>
            <p><strong>Chất liệu kính:</strong> <?php echo $row['glass_material'] ?></p>
            <p><strong>Màu sắc:</strong> <?php echo $row['color'] ?></p>
            <p><strong>Đặc điểm:</strong> <?php echo $row['specs'] ?></p>
            <p><strong>Bảo hành:</strong> <?php echo $row['warranty'] ?></p>
            <p><strong>Loại dây:</strong> <?php echo $row['strap_type'] ?></p>
        </div>
    </div>
</div>

<?php
    } else {
        echo "<p class='alert alert-warning'>Không tìm thấy sản phẩm.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>ID sản phẩm không hợp lệ.</p>";
}
?>
