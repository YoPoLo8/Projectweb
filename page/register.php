<link rel="stylesheet" href="../page/css/register.css">
<?php
// session_start();
include_once('database.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $customername = $_POST['customername'];
    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    // Kiểm tra xem tên đăng nhập đã tồn tại trong cơ sở dữ liệu chưa
    $query = "SELECT * FROM Customer WHERE customername='$customername'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $message = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
    } else {
        // Thêm người dùng mới vào cơ sở dữ liệu
        $insert_query = "INSERT INTO Customer (customername, password, email, phonenumber, address, country) VALUES ('$customername', '$password', '$email', '$phonenumber', '$address', '$country')";
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['success_message'] = "Đăng ký thành công!";
            header('Location: index.php');
            exit();
        } else {
            $message = "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại sau.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Tài Khoản</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Đăng ký Thông Tin</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="customername">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="customername" name="customername" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phonenumber">Số điện thoại:</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="country">Quốc gia:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
