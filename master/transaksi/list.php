<?php 
error_reporting(0);
      if (isset($_GET['hapus'])) {   
        $queryHapus = mysql_query("DELETE FROM product where product_id = '".$_GET['hapus']."'");
            
        if ($queryHapus) {
          echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/product/list' </script>";exit;
        }
      }
 ?>
  <div class="wrapper">
             <div class="row">
                <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading">
                    Data Product
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">

                       

                    </div>
                    <div class="btn-group pull-right">
                    
                    </div>
                </div>
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Order</th>
                    <th>Tanggal Order</th>
                    <th>Petugas</th>
                    <th>Jumlah Item</th>
                    <th style="text-align: right;">Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                      $no = 1;
                      $queryTransaksi = mysql_query("SELECT *
                                                     FROM
                                                        `orders`
                                                       ORDER BY id_orders  DESC");
                      $total=0;
                      while ($rowTransaksi  = mysql_fetch_array($queryTransaksi)) {
                        $sub_total=+$rowTransaksi['product_price'] * $rowTransaksi['jumlah'];
                        //$total+=$sub_total;
                   ?>
                <tr class="">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $rowTransaksi['id_orders']?></td>
                    <td><?php echo $rowTransaksi['tgl_order']?>/<?php echo $rowTransaksi['tgl_order']?></td>
                    <td><?php echo $rowTransaksi['nama_petugas']?></td>
                    <td>
                        <?php 
                            $queryQTY = mysql_query("SELECT SUM(orders_detail.jumlah) AS jumlahqty , product.product_id
                        FROM
                            `orders`
                            INNER JOIN `orders_detail` 
                                ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                            INNER JOIN `product` 
                                ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='".$rowTransaksi['id_orders']."' ");
                            $QTY = mysql_fetch_array($queryQTY);

                            echo $QTY['jumlahqty'];
                         ?>
                    </td>
                    <td style="text-align: right;">
                        <?php
                        $queryTotal=mysql_query("SELECT *
                        FROM
                            `orders`
                            INNER JOIN `orders_detail` 
                                ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                            INNER JOIN `product` 
                                ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='".$rowTransaksi['id_orders']."'");
                            $totalQuery=0;
                        while($rowQueryTotal=mysql_fetch_array($queryTotal)){

                            $subTotal =+$rowQueryTotal['jumlah'] * $rowQueryTotal['product_price'];
                            $totalQuery +=$subTotal; 
                        }
                        echo "Rp. ".number_format($totalQuery,0,',','.');
                        $total+=$totalQuery;
                        ?>
                    </td>
                    <td>
                        <a href="?hal=master/transaksi/detail&id=<?php echo $rowTransaksi['id_orders']; ?>">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-eye"></i> Lihat</button>
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


