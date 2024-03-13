<?php
    session_start();
    include_once('database.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AnanhShop - Trang chủ quản trị</title>
<link rel="stylesheet" type="text/css" href="css/admin.css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
    	<div id="navbar">
        	<ul>
            	<li id="admin-home"><a href="admin.php">trang chủ quản trị</a></li>
                <li><a href="manage-admin.php">thành viên</a></li>
                <li><a href="admin.php?page_layout=danhmucsp">danh mục sản phẩm</a></li>
                <li><a href="admin.php?page_layout=danhsachsp">sản phẩm</a></li>
                <li><a target="_blank" href="../page/index.php">xem website</a></li>
            </ul>
            <div id="user-info">
            	<p>Xin chào <span><?php echo $_SESSION['tk'];?></span> đã đăng nhập vào hệ thống</p>
                <p><a href="Logout.php">Đăng xuất</a></p>
            </div>
        </div>
        <div id="banner">
        	<div id="logo"><a href="#"><img src="" /></a></div>
        </div>
    </div>
    <div id="body">
       <?php
      if(isset($_GET['page_layout'])){
        switch ($_GET['page_layout']){
           case 'them': include_once('them.php');break;
           case 'sua': include_once('sua.php');break;
           case 'danhsachsp': include_once('danhsachsp.php');break;
           case 'danhmucsp' : include_once('danhmucsp.php');break;
           
        }
    }
    else{
        include_once('gioithieu.php');
    }
       ?>	
    
    </div>
    <div id="footer">
    	<div id="footer-info">
        	<h4>Shop Ananh chuyên bán đồng hồ</h4>
            <p><span>Địa chỉ:</span> tầng 04, số 2 Phạm Văn Bạch, Cầu Giấy, Hà Nội | <span>Phone</span> 0334593070 and 0966312103 </p>
            <p>Bản quyền thuộc Ananhshop</p>
        </div>
    </div>
</div>
</body>
</html>
