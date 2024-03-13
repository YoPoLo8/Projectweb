<?php
    include_once('database.php');

    // Lấy danh sách danh mục sản phẩm
    $category = find_category();

    // Kiểm tra xem 'produc_id' có được đặt trong mảng $_GET không
  

    // Xử lý khi form được gửi đi
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $glass_material = $_POST['glass_material'];
        $color = $_POST['color'];
        $specs = $_POST['specs'];
        $warranty = $_POST['warranty'];
        $strap_type = $_POST['strap_type'];
        $category_id = $_POST['category_id'];
        $images = $_FILES['images']['name'];
        // Tiếp tục lấy các trường dữ liệu khác từ form tương tự

        // Câu lệnh SQL cập nhật dữ liệu
        $update_sql = "UPDATE product 
                       SET name = '$name', 
                           size = '$size',
                           price = '$price',
                           glass_material = '$glass_material',
                           color = '$color',
                           specs = '$specs',
                           warranty = '$warranty',
                           strap_type = '$strap_type',
                           category_id = '$category_id',
                           images = '$images'
                           -- Tiếp tục cập nhật các trường dữ liệu khác tương tự
                       WHERE id = $id";

        // Thực hiện truy vấn cập nhật
        $update_query = mysqli_query($conn, $update_sql);

        // Kiểm tra kết quả của truy vấn cập nhật
        if($update_query){
            // Nếu cập nhật thành công, chuyển hướng trở lại trang danh sách sản phẩm và hiển thị thông báo thành công
            header('location: admin.php?page_layout=danhsachsp&success=true');
            exit();
        } else {
            // Nếu có lỗi xảy ra trong quá trình cập nhật, hiển thị thông báo lỗi
            echo "Lỗi trong quá trình cập nhật: " . mysqli_error($conn);
        }
   
       
    } else{

        $produc_id = $_GET['produc_id'];

        // Kiểm tra xem $produc_id có trống không
        if (!empty($produc_id)) {
            // Truy vấn để lấy thông tin sản phẩm cần cập nhật
            $sql = "SELECT * FROM product WHERE id = $produc_id";
            $query = mysqli_query($conn, $sql);

            // Kiểm tra truy vấn có thành công không
            if ($query) {
                $product = mysqli_fetch_assoc($query);
            } else {
                echo "Lỗi trong truy vấn: " . mysqli_error($conn);
            }
        } else {
            echo "produc_id không hợp lệ";
        }


    }
?>




<link rel="stylesheet" type="text/css" href="css/sua.css" />
<h2>Sửa thông tin sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td><span style="display: none;">Mã sản phẩm</span><br /><input type="hidden" id="id" name="id" value="<?php echo $product['id']; ?>"><?php if(isset($id)){echo $id;}?></td>
        </tr>

        <tr>
                <td><label>Tên sản phẩm</label><br /><input type="text" name="name" value="<?php echo $product['name']; ?>" /></td>
            </tr>
            <tr>
            <td>
                <label>Ảnh mô tả</label><br />
                <!-- Hiển thị ảnh sản phẩm hiện tại -->
                <img width="60" src="image/<?php echo htmlspecialchars($product['images']); ?>" alt="Ảnh mô tả" /><br/>
                <!-- Input cho phép người dùng tải lên ảnh mới nếu muốn thay đổi -->
                <input type="file" name="images" />
             </td>
            </tr>

            <tr>
                <td><label>Giá sản phẩm</label><br /><input type="text" name="price" value="<?php echo $product['price']; ?>"  /> USD </td>
            </tr>
            <tr>
                <td><label>Chế độ bảo hành</label><br /><input type="text" name="warranty" value="<?php echo $product['warranty']; ?>" /></td>
            </tr>
            <tr>
                <td><label>Size</label><br /><input type="text" name="size" value="<?php echo $product['size']; ?>" /></td>
            </tr>
            <tr>
                <td><label>Chất liệu mặt kính</label><br /><input type="text" name="glass_material" value="<?php echo $product['glass_material']; ?>" /></td>
            </tr>
            <tr>
                <td><label>Màu sắc</label><br /><input type="text" name="color"  value="<?php echo $product['color']; ?>" /></td>
            </tr>
            <tr>
                <td><label>Loại dây đeo</label><br /><input type="text" name="strap_type" value="<?php echo $product['strap_type']; ?>" /></td>
            </tr>
            <tr>
            <td> <label>Thông tin chi tiết sản phẩm</label><br /> <textarea cols="60" rows="20" name="specs"><?php echo $product['specs']; ?></textarea></td>

            </tr>
            <tr>
            <td>
                <label for="category_id">Loại sản phẩm</label><br />
                <select name="category_id" id="category_id">
                    <option value="1" <?php if($product['category_id'] == '1') echo 'selected'; ?>>AURAWATCH</option>
                    <option value="2" <?php if($product['category_id'] == '2') echo 'selected'; ?>>HUBLOT</option>
                    <option value="3" <?php if($product['category_id'] == '3') echo 'selected'; ?>>ROLEX</option>
                    <option value="4" <?php if($product['category_id'] == '4') echo 'selected'; ?>>RICHARD MILLE</option>
                    <option value="5" <?php if($product['category_id'] == '5') echo 'selected'; ?>>PATEK PHILIPPE</option>
                    <option value="6" <?php if($product['category_id'] == '6') echo 'selected'; ?>>AUDEMARS PIGUET</option>
                </select>
                <?php if(isset($error_category_id)){echo $error_category_id;}?>
            </td>

</tr>

            <tr>
                <td
                    ><input type="submit" name="submit" value="Cập nhật" /> <input type="reset" name="reset" value="Làm mới" />
                    <a href="admin.php?page_layout=danhsachsp" class="btn-back">Quay lại danh sách</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
    include_once('database.php');

    // Kiểm tra xem 'produc_id' có được đặt trong mảng $_GET không
    if (isset($_GET['produc_id'])) {
        $produc_id = $_GET['produc_id'];

        // Kiểm tra xem $produc_id có trống không
        if (!empty($produc_id)) {
            $sql = "SELECT * FROM product WHERE id = $produc_id";
            $query = mysqli_query($conn, $sql);

            // Kiểm tra xem truy vấn có thành công không
            if ($query) {
                $product = mysqli_fetch_assoc($query);
            } else {
                echo "Lỗi trong truy vấn: " . mysqli_error($conn);
            }
        } else {
            echo "produc_id không hợp lệ";
        }
    } else {
        echo "produc_id không được đặt trong URL";
    }
?>

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
    // Kiểm tra xem có thông báo thành công từ trang sửa sản phẩm không
    if(isset($_GET['success']) && $_GET['success'] == 'true'){
        echo '<p class="success-msg">Sản phẩm đã được cập nhật thành công!</p>';
    }
?>

<!-- Các phần còn lại của trang danhsachsp.php -->

