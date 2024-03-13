<?php
    session_start();
    include_once('database.php');

    if (isset($_SESSION['tk'])) {
        // Kiểm tra xem 'category_id' có được đặt trong mảng $_GET không
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];

            // Kiểm tra xem $category_id có trống không
            if (!empty($category_id)) {
                // Sử dụng prepared statement để tăng cường bảo mật
                $sql = "DELETE FROM category WHERE category_id = ?";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Liên kết tham số cho markers
                    mysqli_stmt_bind_param($stmt, "i", $category_id);
                    
                    // Thực thi câu lệnh
                    if (mysqli_stmt_execute($stmt)) {
                        header('Location: admin.php?page_layout=danhmucsp');
                    } else {
                        echo "Lỗi trong truy vấn: " . mysqli_error($conn);
                    }
                    // Đóng câu lệnh
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Lỗi không thể chuẩn bị câu lệnh SQL.";
                }
            } else {
                echo "Category_id không hợp lệ";
            }
        } else {
            echo "Category_id không được đặt trong URL";
        }
    } else {
        header('Location: index.php');
    }
?>
