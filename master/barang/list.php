<?php
if (isset($_GET['hapus'])) {
    $cekGambar = mysql_query("SELECT * FROM product WHERE product_id='".$_GET['hapus']."'");
    $data = mysql_fetch_array($cekGambar);
    if(!empty($data['product_images'])){
        $file = "assets/images/product/".$data['product_images'];
        unlink($file);
    }
    $queryHapus = $connect->query("DELETE FROM barang where id = '" . $_GET['hapus'] . "'");
    if ($queryHapus) {
        echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/barang/list' </script>";
        exit;
    }
}
?>
<div class="fixed-bottom">
<a href="#offcanvas-slide" class="uk-button uk-button-danger text-white uk-button-large" uk-toggle><strong>MENU</strong></a>

<div id="offcanvas-slide" uk-offcanvas>
    <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
            <li class="uk-active">
            <img class="img-fluid" src="assets/images/topos.png"/>
            </li>
            <li>
            <img class="img-fluid" src="assets/images/tpos.png"/>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header uk-active">
            <a href="index.php">
            <span uk-icon="home"></span>
            Home</a></li>
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header uk-active">
            <a href="?hal=dbs">
            <span uk-icon="database"></span>
            Databased</a>
            </li>
           <!-- <li><a href="#">Item</a></li>
            <li><a href="#">Item</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#">Item</a></li>-->
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header uk-active">
            <a href="?hal=sale">
            <span uk-icon="cart"></span>
            POINT OF SALE</a>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header uk-active">
            <a href="?hal=lap">
            <span uk-icon="desktop"></span>
            REPORT DETAIL'S</a>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header uk-active">
            <a href="logout.php">
            <span uk-icon="sign-out"></span>
            SHUT DOWN</a>
            </li>
            <li class="uk-nav-divider"></li>
        </ul>
<!--
       <p>
<small>Modern point of sale web app<br/>
<a href="https://mesinkasironline.web.app">
https://mesinkasironline.web.app</a>
</small>
</p>
-->
    </div>
</div>
</div>
<div class="wrapper">
<div class="row">
        <div class="col-12 col-md-4">
            <section class="panel">
                <header class="panel-heading">
                <img class="img-fluid" src="assets/images/db.png"/>
                <h3>PRODUCT DATABASED</h3>
                            </div>
            
                        <div class="col-12 col-md-8 p-3 p-md-3">
                     
                </header>

                                <a href="?hal=master/barang/add">
                                <button data-toggle="modal" class="uk-button uk-button-primary">
                                       Add New Product
                                    </button>
                                </a>
<hr/>
                        <table class="table" id="editable-sample">
                            <thead>
                            <tr>
                                <!--<th width="5%">No</th>-->
                                <th width="15%">Barcode</th>
                                <th width="13%">Product</th>
                                <th width="10%">Category</th>
                                <th width="12%">Price</th>
                                <th width="6%">Qty</th>
                                <th width="10%">Unit</th>
                                <!--<th>Deskripsi</th>-->
                                <th width="19%">Set</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $queryProduct = $connect->query("SELECT barang.id, barang.kdbrg, barang.nmbrg, barang.harga, barang.stock, category.category_id, category.category_name, satuan.id_satuan, satuan.nmsatuan
                             FROM barang 
                             JOIN category ON barang.category_id = category.category_id
                             JOIN satuan ON barang.id_satuan = satuan.id_satuan
                             ORDER BY id DESC
                             ");
                            while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                                ?>
                                 <tr class="">
                                 	<!--<td><?php echo $no++ ?></td>-->
                                    <td><?php echo $rowProduct['kdbrg'] ?></td>
                                    <td><?php echo $rowProduct['nmbrg'] ?></td>
                                    <td><?php echo $rowProduct['category_name'] ?></td>
                                    <td>Rp. <?php echo number_format($rowProduct['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo $rowProduct['stock'] ?></td>
                                    <td><?php echo $rowProduct['nmsatuan'] ?></td>
                                   <!-- <td><?php echo $rowProduct[''] ?></td>-->
                                    <td>
                                        <a href="?hal=master/barang/edit&id=<?php echo $rowProduct['id']; ?>">
                                            <button class="uk-button uk-button-primary" type="submit">  +
                                            </button>
                                        </a>
                                        <a href="?hal=master/barang/list&hapus=<?php echo $rowProduct['id']; ?>">
                                        <button class="uk-button uk-button-danger" type="submit" name="hapus"> -
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <!--
                                <tr class="">
                                    <td><img src="assets/images/product/<?php echo $rowProduct['product_images']; ?>"
                                             width="100%"></td>
                                    <td><?php echo $rowProduct['product_name'] ?></td>
                                    <td>Rp. <?php echo number_format($rowProduct['product_price'], 0, ',', '.'); ?></td>
                                    <td><?php echo $rowProduct['product_stock'] ?></td>
                                    <td><?php echo $rowProduct['product_desc'] ?></td>
                                    <td>
                                        <a href="?hal=master/product/edit&id=<?php echo $rowProduct['product_id']; ?>">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"
                                                                                             aria-hidden="true"></i>
                                                Edit
                                            </button>
                                        </a>
                                        <a href="?hal=master/product/list&hapus=<?php echo $rowProduct['product_id']; ?>">
                                        <button class="btn btn-danger" type="submit" name="hapus"><i
                                                        class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </a>
                                    </td>
                                </tr>-->
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


