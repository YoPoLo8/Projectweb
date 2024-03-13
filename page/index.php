<?php
session_start();
include_once('database.php');

// Kiểm tra xem người dùng đã đăng ký thành công hay chưa
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    // Xóa thông báo sau khi đã hiển thị
    unset($_SESSION['success_message']);
}

// Kiểm tra nút "Đăng ký Tài Khoản" đã được nhấn hay chưa
$register_clicked = isset($_GET['register']);

ob_start(); // Bắt đầu bộ đệm đầu ra
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AnAnh Watch Shop - Website Bán Hàng Trực Tuyến</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../page/css/index.css">
    <script type="text/javascript">
        /*** 
    Simple jQuery Slideshow Script
    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
***/
        function slideSwitch() {
            var $active = $('#slideshow IMG.active');

            if ($active.length == 0) $active = $('#slideshow IMG:last');

            // use this to pull the anh in the order they appear in the markup
            var $next = $active.next().length ? $active.next() : $('#slideshow IMG:first');

            // uncomment the 3 lines below to pull the anh in random order

            // var $sibs  = $active.siblings();
            // var rndNum = Math.floor(Math.random() * $sibs.length );
            // var $next  = $( $sibs[ rndNum ] );


            $active.addClass('last-active');

            $next.css({
                    opacity: 0.0
                })
                .addClass('active')
                .animate({
                    opacity: 1.0
                }, 1000, function() {
                    $active.removeClass('active last-active');
                });
        }

        $(function() {
            setInterval("slideSwitch()", 2000);
        });

        // Hiển thị danh mục khi di chuột vào "Shop Đồng Hồ"
        $(document).ready(function() {
            var timeout; // Biến để lưu trữ timeout

            // Ẩn danh mục khi di chuột ra khỏi "Shop Đồng Hồ"
            $("#menu-shop-dong-ho").mouseleave(function() {
                // Sử dụng hàm delay để đợi một khoảng thời gian trước khi ẩn phần danh mục
                timeout = setTimeout(function() {
                    $(".shop-dong-ho").hide(); // Ẩn phần danh mục của Shop Đồng Hồ
                }, 5000); // 500 là thời gian trễ (milliseconds), bạn có thể điều chỉnh theo ý muốn
            });

            // Hiển thị danh mục khi di chuột vào "Shop Đồng Hồ"
            $("#menu-shop-dong-ho").mouseenter(function() {
                clearTimeout(timeout); // Xóa bỏ timeout hiện tại nếu có
                $(".shop-dong-ho").show(); // Hiển thị phần danh mục của Shop Đồng Hồ
            });

            // Ẩn danh mục khi di chuột ra khỏi phần danh mục của Shop Đồng Hồ
            $(".shop-dong-ho").mouseleave(function() {
                // Sử dụng hàm delay để đợi một khoảng thời gian trước khi ẩn phần danh mục
                timeout = setTimeout(function() {
                    $(".shop-dong-ho").hide(); // Ẩn phần danh mục của Shop Đồng Hồ
                }, 500); // 500 là thời gian trễ (milliseconds), bạn có thể điều chỉnh theo ý muốn
            });
        });
    </script>
</head>

<body style="background-color: #f2f2f2;">

    <!-- Wrapper -->
    <div id="wrapper" class="responsive">

    <nav class="navbar navbar-light bg-light">
            <div id="logo"><a href="index.php"><img src="../image/image.png" alt="Logo" /></a></div>
            <div id="banner">
                <img src="../image/banner.jpg" alt="Banner Image" style="width: 100%; height: auto;">
            </div>
            <!-- Form tìm kiếm -->
            <form class="form-inline" action="index.php?page_layout=danhsachtimkiem" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="height: 38px;"><img src="../image/search-icon.jpg" alt="search" /></span>
                    </div>
                    <input type="text" class="form-control" name="stext" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" aria-describedby="basic-addon1">
                </div>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>


        <ul class="nav justify-content-center">
             <ul class="nav">
                        <li class="nav-item" id="menu-home"><a class="nav-link" href="index.php">Trang Chủ</a></li>
                        <li class="nav-item" id="menu-shop-dong-ho">
                    <a class="nav-link" href="index.php?page_layout=danhmucsp">Các loại đồng hồ</a>
                        <li class="nav-item"><a class="nav-link" href="index.php?page_layout=danhsachsp">Sản Phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page_layout=lienhe">Liên Hệ</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?register=true">Đăng ký Tài Khoản</a></li><!-- Thêm tham số register=true để báo hiệu rằng nút đã được nhấn -->
                    </ul>
        </ul>

       

        <!-- End Header -->

        
        <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide mx-auto" data-ride="carousel" style="width: 100%; height: 300px;">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/15.4.jpg" class="d-block w-100" style="width: 540px; height: 300px;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../image/14.2.png" class="d-block w-100" style="width: 540px; height: 300px;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../image/LOGO3.png" class="d-block w-100" style="width: 540px; height: 300px;" alt="...">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                    <div class="l-sidebar">
                        <h2 id="shop-dong-ho">Các loại đồng hồ</h2>
                        <ul class="nav flex-column shop-dong-ho" style="display: none;">

                            <?php
                            $sql = "SELECT * FROM category";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page_layout=danhsachsp&category_id=<?php echo $row['category_id'] ?>&category_name=<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>



<br>

        <!-- Body -->
        <div id="body">
            <!-- Left Column -->
            <div id="l-col" <?php if ($register_clicked) echo 'style="display: none;"'; ?>>
                <!--Danh mục-->
                
            </div>
            <!-- End Left Column -->

            <!-- Right Column -->
            <div id="r-col">
                <!--slideshow-->
                <?php // include_once('slideshow/slideshow.php'); ?>
                <div id="main">
                    <!-- Hiển thị form đăng ký nếu nút "Đăng ký Tài Khoản" đã được nhấn -->
                    <?php if ($register_clicked) : ?>
                        <?php include_once('register.php'); ?>
                    <?php else : ?>
                        <!-- Hiển thị thông báo nếu có -->
                        <?php if (isset($success_message)) : ?>
                            <div class="success-message text-center"><?php echo $success_message; ?></div>
                        <?php endif; ?>

                        <?php
                        if (isset($_GET['page_layout'])) {
                            switch ($_GET['page_layout']) {
                                case 'lienhe':
                                    include_once('menungang/lienhe.php');
                                    break;
                                case 'chitietsp':
                                    include_once('sanpham/chitietsp.php');
                                    break;
                                case 'danhsachsp':
                                    include_once('sanpham/danhsachsp.php');
                                    break;
                                    case 'danhmucsp':
                                        include_once('sanpham/danhmucsp.php');
                                        break;                                
                                case 'danhsachtimkiem':
                                    include_once('search/search_list.php');
                                    break;
                                    
                                default:
                            }
                        } else {
                        }
                        ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Right Column -->

            <div class="container text-center">
    <div id="brand"></div>
</div>

<div class="container text-center">
    <div class="urp">
        <h1>Tin Tức</h1>
        <h3>"Cập nhật tin tức hay mới nhất về đồng hồ, kính mắt, quà tặng, thông tin tổng hợp được cập nhật 24h. Các bài viết review đánh giá, tư vấn và hướng dẫn sử dụng sản phẩm..."</h3>
        <div id="group" class="d-flex justify-content-center">
            <!-- Tin tức 1 -->
            <div class="card mx-3" style="width: 22rem;">
                <img src="../image/26.1.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Tin tức 1</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="https://plo.vn/cong-an-xuat-hien-o-khu-vuc-nha-rieng-bi-thu-chu-tich-tinh-vinh-phuc-va-cuu-chu-tich-tinh-quang-ngai-post779484.html" class="btn btn-primary" target="_blank">Đọc tiếp</a>
                </div>
            </div>
            <!-- Tin tức 2 -->
            <div class="card mx-3" style="width: 22rem;">
                <img src="../image/11.4.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Tin tức 2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="https://plo.vn/cong-an-xuat-hien-o-khu-vuc-nha-rieng-bi-thu-chu-tich-tinh-vinh-phuc-va-cuu-chu-tich-tinh-quang-ngai-post779484.html" class="btn btn-primary" target="_blank">Đọc tiếp</a>
                </div>
            </div>
            <!-- Tin tức 3 -->
            <div class="card mx-3" style="width: 22rem;">
                <img src="../image/10.4.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Tin tức 3</h5>
                    <p class="card-text">Công an xuất hiện ở khu vực nhà riêng Bí thư, Chủ tịch tỉnh Vĩnh Phúc và cựu Chủ tịch tỉnh Quảng Ngãi</p>
                    <a href="https://plo.vn/cong-an-xuat-hien-o-khu-vuc-nha-rieng-bi-thu-chu-tich-tinh-vinh-phuc-va-cuu-chu-tich-tinh-quang-ngai-post779484.html" class="btn btn-primary" target="_blank">Đọc tiếp</a>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

        <!-- Footer -->
        <footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Shop Ananh chuyên bán đồng hồ</h4>
                <p><span>Địa chỉ:</span> tầng 04, số 2 Phạm Văn Bạch, Cầu Giấy, Hà Nội | <span>Phone</span> 0334593070 and 0966312103</p>
                <p>Bản quyền thuộc Ananhshop</p>
            </div>
        </div>
    </div>
</footer>

        <!-- End Footer -->
    </div>
    <!-- End Wrapper -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php
ob_end_flush(); // Kết thúc và gửi dữ liệu từ bộ đệm đầu ra đến trình duyệt
?>