<?php
include_once('database.php');

// Kiểm tra xem 'category_id' có được đặt trong mảng $_GET không
if(isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Kiểm tra xem $category_id có trống không
    if (!empty($category_id)) {
        // Xử lý khi form được gửi đi
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $category_name = $_POST['category_name'];
            $images = $_FILES['images']['name'];

            // Cập nhật dữ liệu vào cơ sở dữ liệu
            $update_sql = "UPDATE category 
                           SET category_name = '$category_name', 
                               images = '$images'
                           WHERE category_id = $category_id";

            // Thực hiện truy vấn cập nhật
            $update_query = mysqli_query($conn, $update_sql);

            // Kiểm tra kết quả của truy vấn cập nhật
            if($update_query) {
                // Nếu cập nhật thành công, chuyển hướng trở lại trang danh sách sản phẩm và hiển thị thông báo thành công
                header('location: admin.php?page_layout=danhmucsp&success=true');
                exit();
            } else {
                // Nếu có lỗi xảy ra trong quá trình cập nhật, hiển thị thông báo lỗi
                echo "Lỗi trong quá trình cập nhật: " . mysqli_error($conn);
            }
        } else {
            // Truy vấn để lấy thông tin danh mục sản phẩm cần sửa
            $sql = "SELECT * FROM category WHERE category_id = $category_id";
            $query = mysqli_query($conn, $sql);

            // Kiểm tra truy vấn có thành công không
            if ($query) {
                $category = mysqli_fetch_assoc($query);
            } else {
                echo "Lỗi trong truy vấn: " . mysqli_error($conn);
            }
        }
    } else {
        echo "category_id không hợp lệ";
    }
} else {
    echo "category_id không được đặt trong URL";
}
?>

<link rel="stylesheet" type="text/css" href="css/sua.css" />
<h2>Sửa thông tin danh mục sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="edit-category" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><span style="display: none;">Mã danh mục sản phẩm</span><br /><input type="hidden" id="category_id" name="category_id" value="<?php echo $category['category_id']; ?>"><?php if(isset($category_id)){echo $category_id;}?></td>
            </tr>
            <tr>
                <td><label>Tên danh mục sản phẩm</label><br /><input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" /></td>
            </tr>
            <tr>
                <td>
                    <label>Ảnh mô tả</label><br />
                    <!-- Hiển thị ảnh danh mục sản phẩm hiện tại -->
                    <img width="60" src="image/<?php echo htmlspecialchars($category['images']); ?>" alt="Ảnh mô tả" /><br/>
                    <!-- Input cho phép người dùng tải lên ảnh mới nếu muốn thay đổi -->
                    <input type="file" name="images" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Cập nhật" />
                    <a href="admin.php?page_layout=danhmucsp" class="btn-back">Quay lại danh mục sản phẩm</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    // Xử lý khi nhấn nút Cập nhật
    // Code xử lý cập nhật dữ liệu vào cơ sở dữ liệu

    // Sau khi cập nhật thành công, chuyển hướng trở lại trang danh sách sản phẩm
    header('location: admin.php?page_layout=danhsachsp');
    exit(); // Đảm bảo không có mã HTML hoặc văn bản khác được xuất ra sau hàm header
}
?>
<?php
// Kiểm tra xem có thông báo thành công từ trang sửa danh mục sản phẩm không
if(isset($_GET['success']) && $_GET['success'] == 'true'){
    echo '<p class="success-msg">Danh mục sản phẩm đã được cập nhật thành công!</p>';
}
?>

<!-- Các phần còn lại của trang danhsachsp.php -->
