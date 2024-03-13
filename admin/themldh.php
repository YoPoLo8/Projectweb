<?php
include_once('database.php');
$error = NULL;
$error_name = NULL;
$error_images = NULL;

if(isset($_POST['submit'])){
    // Kiểm tra liệu có để trống trường dữ liệu không
    $id = $_POST['id'];
    $name = $_POST['name'];
    $images = $_FILES['images']['name'];
    
    // Bẫy lỗi để trống trường dữ liệu trong Form
    if(empty($id)){
        $error = '<span style="color:red;">(*)</span>';
    }

    if(empty($name)){
        $error_name = '<span style="color:red;">(*)</span>';
    }

    if(empty($images)){
        $error_images = '<span style="color:red;">(*)</span>';
    } else {
        // Điều chỉnh đường dẫn và tên file ảnh để tránh trùng lặp hoặc lỗi
        $tmp = $_FILES['images']['tmp_name'];
        // Bạn có thể thêm logic để đổi tên file ảnh ở đây
        move_uploaded_file($tmp, "uploads/".$images); // Lưu file ảnh vào thư mục uploads
    }

    if(!empty($id) && !empty($name) && !empty($images)){
        $sql = "INSERT INTO category (category_name, images) 
                VALUES ('$name', '$images')";

        // Thực thi câu lệnh SQL
        if (mysqli_query($conn, $sql)) {
            echo "Dữ liệu đã được thêm vào bảng category thành công.";
            header('Location: admin.php?page_layout=danhmucsp');
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    } 
}
?>

<link rel="stylesheet" type="text/css" href="css/them.css" />
<h2>Thêm loại sản phẩm mới</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
    <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td><label>Mã sản phẩm</label><br /><input type="text" name="id" /><?php if(isset($error)){echo $error;}?></td>
        </tr>    
        <tr>
            <td><label>Tên sản phẩm</label><br /><input type="text" name="name" /><?php if(isset($error_name)){echo $error_name;}?></td>
        </tr>
        <tr>
            <td><label>Ảnh mô tả</label><br /><input type="file" name="images" /><?php if(isset($error_images)){echo $error_images;}?></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Thêm mới" /> <input type="reset" name="reset" value="Làm mới" /></td>
        </tr>
    </table>
    </form>
</div>
