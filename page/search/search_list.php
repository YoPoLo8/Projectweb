<link rel="stylesheet" href="../page/css/search.css">
<div class="container">
    <div class="row">
        <div class="col">
            <?php
                if(isset($_POST['stext'])){
                    $stext = $_POST['stext'];
                } else {
                    $stext = '';
                }
                $newStext = str_replace(' ', '%', $stext);
                $sql = "SELECT * FROM product WHERE name LIKE '%$newStext%'";
                $query = mysqli_query($conn, $sql);
            ?>
            <h2 class="text-center">Kết quả tìm được với từ khóa "<span class="skeyword"><?php echo $stext ?></span>"</h2>
            <div class="row">
                <?php
                    $i = 0;
                    while($row = mysqli_fetch_array($query)){
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="../page/sanpham/image/<?php echo $row['images'] ?>" class="card-img-top" alt="Product Image" style="width: 100%; max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></h5>
                            <p class="card-text">Size: <?php echo $row['size'] ?></p>
                            <p class="card-text">Glass Material: <?php echo $row['glass_material'] ?></p>
                            <p class="card-text"><strong>Giá: <?php echo $row['price'] ?> USD</strong></p>
                        </div>
                    </div>
                </div>
                <?php
                    $i++;
                    if($i % 3 == 0){
                        echo '<div class="w-100"></div>';
                    }
                    }
                ?>
            </div>
        </div>
    </div>
</div>

