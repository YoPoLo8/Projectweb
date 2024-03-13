<div class="prd-block">
    <h2>sản phẩm đặc biệt</h2>
    <div class="pr-list">
    <?php
        $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 0,6";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($query)){
    ?>
        <div class="prd-item">
        <a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>"><img width="80" height="144" src="image/<?php echo $row['imeges'] ?>" /></a>
            <h3><a href="index.php?page_layout=chitietsp&id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></h3>
            <p>Size: <?php echo $row['size'] ?></p>
            <p>Glass Material: <?php echo $row['glass material'] ?></p>
            <p class="price"><span>Giá: <?php echo $row['price'] ?> '$'</span></p>
        </div>
    <?php
        }
    ?>
        <div class="clear"></div>
    </div>
</div>