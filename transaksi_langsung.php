<?php 
include "config.php";

 ?>
        <!--body wrapper start-->
        <div class="fixed-top">
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
    <div class="col-sm-5">
    <img class="img-fluid" src="assets/images/lap1.png"/>

    </div>

        <div class="col-sm-7">
            <section class="panel">
                <header class="panel-heading">
                    <h3>List Point Of Sale</h3><hr/>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                       
                        <table class="table" id="editable-sample">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%">No</th>
                                <th width="15%">Ticket</th>
                                <th width="20%">Date</th>
                                <th width="20%">Qty</th>
                                <!--<th>Deskripsi</th>-->
                                <th width="10%">Set</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $no = 1;
                            $queryProduct = $connect->query("SELECT orders_detail.id_orders, orders_detail.product_id, orders_detail.jumlah, orders_detail.tgl_order,barang.id, barang.nmbrg FROM orders_detail JOIN barang ON orders_detail.product_id = barang.id GROUP BY tgl_order DESC");

                            

                            while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                                $jumlah =  $connect->query("SELECT jumlah FROM orders_detail WHERE tgl_order = '".$rowProduct['tgl_order']."'
                                             ");
                                    $totjumlah = mysqli_num_rows($jumlah);


                                ?>
                                 <tr class="">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowProduct['id_orders'] ?></td>
                                    <td><?php echo $rowProduct['tgl_order'] ?></td>
                                    <td><?php echo $totjumlah; ?> Item</td>
                                    
                                    <td>
                                        <a href="index.php?hal=detail_transaksi_langsung&id_orders=<?php echo $rowProduct['id_orders']; ?>">
                                            <button class="uk-button uk-button-secondary" type="submit"><i class="fa fa-book" aria-hidden="true"></i>
                                                Check
                                            </button>
                                        </a>
                                       
                                    </td>
                                </tr>
                               
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
       