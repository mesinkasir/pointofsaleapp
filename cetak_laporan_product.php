<?php
include 'config.php';
?>
    
<!doctype html>
<html>
    <head>
        <title>Laporan Data Barang</title>
        <link rel="shortcut icon" href="../img/laporan.png">
        <link rel="stylesheet" type="text/css" href="css/laporan.css">   
        <link href="css/custom.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link  href="css/bootstrap-responsive.min.css"  rel ="stylesheet"> 
        <link  href="font-awesome/css/font-awesome.min.css"  rel ="stylesheet"> 
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            table{
                border-collapse: collapse;
            }
            table th{
                padding: 6px 5px;
            }
            table tr td{
                font-size: 12px;
                padding: 3px 2px;
            }
        </style>
    </head>
    <body>
            <h3 align="center">BEST SELLER PRODUCTS </h3>       
        <div class="page">
             <h5><b>TOPOS Toko Point Of Sale App</b></h5>
             Modern POS web app technology<br> https://mesinkasironline.web.app<br>
             <br>
             By date: <?php echo date('d-m-y') ?>
             <br>
        <div class="kop">
            <!--<img src="../img/kop.png" id="kop"><br>-->
           
        
            </div>
        <table border="1px">
            <tr class="head">
                <th width="15">NO. </th><th width="150">BARCODE</th><th width="150">PRODUCT</th><th width="150">PRICE</th><th width="150">SOLD</th>
            </tr><?php

            
               $queryProduct = $connect->query("SELECT * 
                             FROM barang  ORDER BY total_terjual DESC
                             ");

                
                $nomor  = 0; 
                while ($barang = mysqli_fetch_array($queryProduct)) {
                $nomor++;
            ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $barang['kdbrg'];?></td>
                        <td><?php echo $barang['nmbrg'];?></td>
                        <td><?php echo $barang['harga'];?></td>
                        <td><?php echo $barang['total_terjual'];?></td>
                    </tr>
            <?php } ?>
           
                    
        </table>
           <p>https://mesinkasironline.web.app</p>
        </div>
    </body>
</html>