<?php 
include 'config.php';
error_reporting(0);
$id_orders = $_GET['id_orders'];



$queryRowProduct = $connect->query("SELECT orders_detail.id_orders, orders_detail.product_id, orders_detail.jumlah, orders_detail.tgl_order, barang.id, barang.nmbrg, barang.harga 
    FROM orders_detail JOIN barang ON orders_detail.product_id = barang.id 
    WHERE id_orders = '$id_orders'
    ");

    
$queryRowProduct2 = $connect->query("SELECT orders_detail.id_orders, orders_detail.product_id, orders_detail.jumlah, orders_detail.tgl_order, barang.id, barang.nmbrg, barang.harga 
    FROM orders_detail JOIN barang ON orders_detail.product_id = barang.id 
    WHERE id_orders = '$id_orders'
    ");

 $rowProduct = mysqli_fetch_array($queryRowProduct2);



                     
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
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
            <div class="col-md-4"></div>
               <div class="col-md-4">
                <section class="panel">
                <header class="panel-heading text-center">
<h4>DETAIL TRANSACTION</h4>
                        </header>
<hr>
            <div class="panel">
                <div class="panel-body"> 
                   
                    <p align="left"><?=$id_orders;?> </p>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="blog-post">
                        <div class="media">
                            <div class="panel-body">
                                <div class="panel"> 
                                        <p align="left"> <?=$rowProduct['tgl_order'];?> </p>
                                </div>
                                <h5 align="right"> </h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                   $total = 0;
                                    while ($data = mysqli_fetch_array($queryRowProduct)) {
                                        $sub_total = $data['harga'] * $data['jumlah'];
                                        $total += $sub_total;
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$data['nmbrg'] ?></td>
                                            <td>
                                                Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                            <td><?php echo $data['jumlah']; ?></td>
                                            <td>Rp. <?php echo number_format($sub_total, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tr>
                                        <td colspan="3">
                                            Grand Total
                                        </td>
                                        <td>Rp.
                                            <?php echo number_format($total, 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                         <tr>
                                        <td colspan="4" align="reight">
                                            
                                        <a href="index.php?hal=transaksi_langsung"
                                         class="btn btn-dark btn-block">
                                                 Back
                                         </a>
                                       <!--  </form> -->
                                       
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div> 
        <div class="col-md-4"></div>
            </div>
        </div>
        <!--body wrapper end-->

