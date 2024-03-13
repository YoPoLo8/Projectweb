<?php
    session_start();
    include_once('database.php');

    if (isset($_SESSION['tk'])) {
        // Kiểm tra xem 'produc_id' có được đặt trong mảng $_GET không
        if (isset($_GET['produc_id'])) {
            $produc_id = $_GET['produc_id'];

            // Kiểm tra xem $produc_id có trống không
            if (!empty($produc_id)) {
                $sql = "DELETE FROM product WHERE id = $produc_id";
                $query = mysqli_query($conn, $sql);

                // Kiểm tra xem truy vấn có thành công không
                if ($query) {
                    header('location:admin.php?page_layout=danhsachsp');
                } else {
                    echo "Lỗi trong truy vấn: " . mysqli_error($conn);
                }
            } else {
                echo "produc_id không hợp lệ";
            }
        } else {
            echo "produc_id không được đặt trong URL";
        }
    } else {
        header('location:index.php');
    }
?>
