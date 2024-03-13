<?php
session_start();
include_once('database.php');

$error = NULL;
if(isset($_POST['submit'])){
    if($_POST['tk']=="" || $_POST['mk']==""){
        $error = "Vui lòng nhập tài khoản và mật khẩu";
    }else{
        echo($tk."-".$mk );
        
        $tk = $_POST['tk'];
        $mk = $_POST['mk'];

        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost"; // Thay đổi thành tên máy chủ MySQL của bạn
        $username = "root"; // Thay đổi thành tên người dùng MySQL của bạn
        $password = ""; // Thay đổi thành mật khẩu MySQL của bạn
        $dbname = "ananh"; // Thay đổi thành tên cơ sở dữ liệu của bạn

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối không thành công: " . $conn->connect_error);
        }

        // Thực hiện truy vấn SQL
        $sql = "SELECT * FROM admins WHERE username='$tk' AND password = SHA1('$mk')";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            // Đăng nhập thành công
            $_SESSION['tk'] = $tk;
            $_SESSION['mk'] = $mk;
            header('location:admin.php');
            exit;
        } else {
            // Sai tên đăng nhập hoặc mật khẩu
            $error = 'Tài khoản hoặc mật khẩu không chính xác';
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ananhshop - Đăng nhập hệ thống</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body>
    <?php
    if(!isset($_SESSION['tk'])){
    ?>
    <form method="post">
    <div id="form-login">
        <h2>đăng nhập hệ thống quản trị</h2>
        <center><span style="color:red;"><?php echo $error;?></span></center>
        <ul>
            <li><label>tài khoản</label><input type="text" name="tk" /></li>
            <li><label>mật khẩu</label><input type="password" name="mk" /></li>
            <li><input type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="resset" value="Làm mới" /></li>
        </ul>
    </div>
    </form>
    <?php
    }else{
        header('location:admin.php');
    }
    ?>
</body>
</html>