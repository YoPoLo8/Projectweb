<?php
include_once('database.php');

$categories = find_category();

$error = NULL;

if(isset($_POST['submit'])){
    if($_POST['id'] == ''){
        $error = '<span style="color:red;">(*)<span>';
    }
   
    if($_POST['name'] == ''){
        $error_name = '<span style="color:red;">(*)<span>';
    }

    if($_POST['size'] == ''){
        $error_size = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['price'] == ''){
        $error_price = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['glass_material'] == ''){
        $error_glass_material = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['color'] == ''){
        $error_color = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['specs'] == ''){
        $error_specs = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['warranty'] == ''){
        $error_warranty = '<span style="color:red;">(*)<span>';
    }
    
    if($_FILES['images']['name'] == ''){
        $error_images = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['category_id'] == 'unselect'){
        $error_category_id = '<span style="color:red;">(*)<span>';
    }
    
    if($_POST['strap_type'] == ''){
        $error_strap_type = '<span style="color:red;">(*)<span>';
    }
    
    $color = $_POST['color'];
    $category_id = $_POST['category_id'];
    $strap_type = $_POST['strap_type'];
    $images = $_FILES['images']['name'];
    $tmp = $_FILES['images']['tmp_name'];
    $warranty = $_POST['warranty'];
    $specs = $_POST['specs'];
    $glass_material = $_POST['glass_material'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $name = $_POST['name'];

    $sql = "INSERT INTO product (name, size, price, glass_material, color, specs, warranty, strap_type, category_id, images) 
        VALUES ('$name', '$size', '$price', '$glass_material', '$color', '$specs', '$warranty', '$strap_type', '$category_id', '$images')";

    if (mysqli_query($conn, $sql)) {
        echo "Dữ liệu đã được thêm vào bảng product thành công.";
        header('location:admin.php?page_layout=danhsachsp');
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }   
}
?>

<link rel="stylesheet" type="text/css" href="css/them.css" />
<h2>Thêm mới sản phẩm</h2>
<div id="main">
    <form method="post" action enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>Mã sản phẩm</label><br /><input type="text" id="id" name="id" /><?php if(isset($id)){echo $id;}?></td>
            </tr>   
            <tr>
                <td><label>Tên sản phẩm</label><br /><input type="text" name="name" /><?php if(isset($error_name)){echo $error_name;}?></td>
            </tr>
            
            <tr>
                <td><label>Ảnh mô tả</label><br /><input type="file" name="images" /><?php if(isset($error_images)){echo $error_images;}?></td>
            </tr>
            <tr>
                <td><label>Giá sản phẩm</label><br /><input type="text" name="price" /> USD <?php if(isset($error_price)){echo $error_price;}?></td>
            </tr>
            <tr>
                <td><label>Chế độ bảo hành</label><br /><input type="text" name="warranty" /><?php if(isset($error_warranty)){echo $error_warranty;}?></td>
            </tr>
            <tr>
                <td><label>Size</label><br /><input type="text" name="size" /><?php if(isset($error_phu_kien)){echo $error_phu_kien;}?></td>
            </tr>
            <tr>
                <td><label>Chất liệu mặt kính</label><br /><input type="text" name="glass_material" value="Shapphire" /><?php if(isset($error_glass_material)){echo $error_glass_material;}?></td>
            </tr>
            <tr>
                <td><label>Màu sắc</label><br /><input type="text" name="color"  /><?php if(isset($error_color)){echo $error_color;}?></td>
            </tr>
            <tr>
                <td><label>Loại dây đeo</label><br /><input type="text" name="strap_type" /><?php if(isset($error_strap_type)){echo $error_strap_type;}?></td>
            </tr>
            <tr>
                <td>
                    <label for="category_id">Loại sản phẩm</label><br />
                    <select name="category_id" id="category_id">
                        <?php 
                        foreach($categories as $category) {
                            echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                        }
                        ?>
                    </select>
                    <?php if(isset($error_category_id)){echo $error_category_id;}?>
                </td>
            </tr>
            <tr>
                <td><label>Thông tin chi tiết sản phẩm</label><br /><textarea cols="60" rows="12" name="specs"></textarea><?php if(isset($error_specs)){echo $error_specs;}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Thêm mới" /> <input type="reset" name="reset" value="Làm mới" /></td>
            </tr>
        </table>
    </form>
</div>
