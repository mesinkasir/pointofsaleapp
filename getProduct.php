<?php
include("config.php");
$keywords = $_GET['keywords'];
$queryProduct = mysql_query("SELECT * FROM product WHERE product_name LIKE '%" . $keywords . "%' ");
while ($rowsProduct = mysql_fetch_array($queryProduct)) {
    if (count($rowsProduct) == 1) { ?>
        <div class="images item ">
            <h1>Product yang anda cari masih kosong</h1>
        </div>
    <?php } else {
        ?>
        <div class="images item ">
            <a href="cart.php?mod=basket&act=add&id=<?php echo $rowsProduct['product_id'] ?>" data-toggle="modal">
                <img src="assets/images/product/<?php echo $rowsProduct['product_images']; ?>" alt=""/>
            </a>
            <p><?php echo $rowsProduct['product_name']; ?> </p>
        </div>
    <?php }
} ?>
