<?php
session_start();
error_reporting(0);
//define("SITE_HOST", "http://".$_SERVER['HTTP_HOST']."/kasir/");//.HOST_URI);
//error_reporting(0);
include 'config.php';   //  echo $_SESSION['username']; exit();
include 'function.php';
if (!empty($_SESSION["username"]) && !empty($_SESSION['password'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" href="#" type="assets/image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>TOPOS - TOKO POINT OF SALE</title>
        <!--icheck-->

        <!--   
          <link href="assets/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/square.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/red.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/blue.css" rel="stylesheet"> 
        -->

        <!-- data picker -->

        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker-custom.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-timepicker/css/timepicker.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-colorpicker/css/colorpicker.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datetimepicker/css/datetimepicker-custom.css"/>


        <link href="assets/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="assets/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="assets/js/iCheck/skins/square/blue.css" rel="stylesheet">

        <!--dashboard calendar-->
        <link href="assets/css/clndr.css" rel="stylesheet">

        <!--file upload-->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-fileupload.min.css" />
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/js/morris-chart/morris.css">

        <!--common-->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">

        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <!--[endif]-->
    </head>

    <body class="bg-light">
<h1 class="text-center">POINT OF SALE</h1>
    <section>
  
    <?php 
include "config.php";

session_start();
if(!isset($_SESSION['id_session'])){
    $ids = date("YmdHis");
    $_SESSION['id_session'] = $ids;
}
$id_session=$_SESSION['id_session'];

error_reporting(0);
$id = $_GET['id'];
$queryRowProduct = $connect->query("SELECT * FROM barang where id = '".$id."'");
$rowProduct = mysqli_fetch_array($queryRowProduct);
    /*
    if (isset($_POST['ubah']) {  
    
      if (!empty($_FILES) && $_FILES['product_images']['size'] >0 && $_FILES['user_foto']['error'] == 0){  
            //$random = substr(number_format(time() * rand(),0,'',''),0,10);
            $images = $_FILES['product_images']['name'];
            $move = move_uploaded_file($_FILES['product_images']['tmp_name'],'assets/images/product/'.$images);  

            if ($move) {  
              $queryUpdate  = mysql_query("UPDATE product SET 
                                    product_name      = '".$_POST['product_name']."',
                                    product_price     = '".str_replace(".", "", $_POST['product_price'])."',
                                    product_desc      = '".$_POST['product_desc']."',
                                    product_images    = '".$images."',
                                    product_stock     = '".str_replace(".", "", $_POST['product_stock'])."',
                                    category_id       = '".$_POST['product_category']."'
                                    WHERE product_id     = '".$id."'
                                     ");
                $file = "assets/images/product/".$rowProduct['product_images'];
                unlink($file);
                                             
            }

      }else{  
        */
       

          if(isset($_POST['ubah'])){  
                $queryUpdate=$connect->query("UPDATE barang SET
                                                    nmbrg = '".$_POST['product_name']."',
                                                    harga = '".str_replace(".", "", $_POST['product_price'])."',
                                                    stock = '".str_replace(".", "", $_POST['product_stock'])."',
                                                    category_id       = '".$_POST['product_category']."' ,
                                                    nmsatuan = '".$_POST['satuan']."'  
                                                    WHERE id    = '".$id."' "); 
         if($queryUpdate === TRUE){
         
echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
           }else{
            echo "ERROR UBAH DATA =" .$sql->connect_error;
           }
            }                        
       
     // if ($queryUpdate) {
       //  echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
      //}
    //}
 ?>
        <!--body wrapper start-->
<div class="container">
       <div class="wrapper">
    <div class="row">
     
        <div class="col-sm-8 p-3 p-md-3">
            <section class="panel">
               <!-- <header class="panel-heading">
                    <h4>POINT OF SALE</h4>
       
                </header>-->
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">

                            <div class="btn-group pull-right">
                            </div>
                        </div>
                        <div class="space15"></div>
                        <table class="table" id="editable-sample">
                            <thead>
                            <tr class="bg-dark text-white">
                                <!--<th width="5%">No</th>-->
                                <th width="20%">Barcode</th>
                                <th width="20%">Product</th>
                                <th width="15%">Price</th>
                                <th width="15%">Stock</th>
                                <!--<th>Deskripsi</th>-->
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $queryProduct = $connect->query("SELECT barang.id, barang.kdbrg, barang.nmbrg, barang.harga, barang.stock, category.category_id, category.category_name, satuan.id_satuan, satuan.nmsatuan
                             FROM barang 
                             JOIN category ON barang.category_id = category.category_id
                             JOIN satuan ON barang.id_satuan = satuan.id_satuan
                             ORDER BY id DESC");
                            while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                                ?>
                                 <tr class="">
                                   <!-- <td><?php echo $no++ ?></td>-->
                                    <td><?php echo $rowProduct['kdbrg'] ?></td>
                                    <td><?php echo $rowProduct['nmbrg'] ?></td>
                                    <td>Rp. <?php echo number_format($rowProduct['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo $rowProduct['stock'] ?></td>
                                   <!-- <td><?php echo $rowProduct[''] ?></td>-->
                                    <td>
                                        <a href="cart.php?&input=add&id_barang=<?=$rowProduct['id']?>&id_session=<?=$id_session?>">
                                            <button class="btn btn-primary" type="submit">
                                                Select
                                            </button>
                                        </a>
                                        <!-- <a href="?hal=master/barang/list&hapus=<?php echo $rowProduct['id']; ?>">
                                        <button class="btn btn-danger" type="submit" name="hapus"><i
                                                        class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </a> -->
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
           <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">

                    <div class="blog-post bg-dark">

                        <div class="media">
                            <div class="panel-body bg-dark ">
                                <table class="table bg-dark text-white">
                                    <thead>
                                    <tr>
                                        <td></td>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $query = "SELECT keranjang.id_keranjang, keranjang.id_session, keranjang.tgl_keranjang, keranjang.jam_keranjang, keranjang.qty,
                        barang.id, barang.kdbrg, barang.nmbrg, barang.harga, barang.stock 
                        FROM keranjang 
                        JOIN barang ON keranjang.id_barang = barang.id
                        WHERE id_session='$id_session'";

                                    $result = mysqli_query($connect, $query);
                                    $no = 1;
                                    $total = 0;

                                    while ($data = mysqli_fetch_array($result)) {
                                        $sub_total = +$data['harga'] * $data['qty'];
                                        $total += $sub_total;
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="hapus_keranjang.php?hapus=<?=$data['id_keranjang']?>&id_session=<?=$data['id_session'] ?>"><i
                                                            class="fa fa-times" style="color: red"></i></a>
                                            </td>
                                            <td>
                                                <?php echo $data['nmbrg'] ?></td>
                                            <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                            <td><?php echo $data['qty']; ?></td>
                                            <td><?php echo number_format($sub_total, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4">
Grand Total
                                        </td>
                                        <td>
                                            <?php echo number_format($total, 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="reight">

                                            <button class="btn btn-danger btn-lg btn-block" type="submit" data-toggle="modal"
                                                    data-target="#myModal">Payment
                                            </button>
                                        </td>

                                        <div class="modal fade rounded" id="myModal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog p-3 p-md-3">
                                                <div class="modal-content bg-dark text-white p-3 p-md-3">
                                                <h3 class="text-center text-white p-3 p-md-5">TRANSACTION</h3>
                                                    <div class="modal-header bg-dark text-white">
                                                    <?php?>
                                                        <h2 class="modal-title text-white">TOTAL :
                                                            Rp. <?php echo number_format($total, 0, ',', '.'); ?></h2>
                                                    </div>

                                                    <div class="modal-body row">
                                                        <div class="col-sm-12 p-3 p-md-3">
                                                            <!--<form method="POST" action="?hal=cetak">-->
                                                                <form method="POST" action="cetak.php">
                                                                <div class="form-group">
                                                                    <label><h3 class="text-white"> PAYMENT</h3></label>

                                                                </div>


                                                                <div class="form-group">
                                                                    <input type="hidden" id="type1" name="grand_total"
                                                                           onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);"
                                                                           value="<?php echo number_format($total, 0, ',', '.'); ?>"/>

                                                                    <input type="text" class="form-control input-lg" placeholder="input payment"
                                                                           id="type2" name="cash"
                                                                           onKeyUp="kalkulatorTambah(getElementById('type1').value,this.value);"
                                                                           />


                                                                </div>

                                                                <div class="form-group">

                                                                    <label><h3 class="text-white">CHANGE</h3></label>
                                                                    <input type="hidden" name="kembalian"
                                                                           id="kembalian">
                                                                    <h1>

                                                               <span class="bg-danger text-white p-3 p-md-3" id="result">
                                                                </span></h1>
                                                                </div>

                                                                <div class="pull-right">

                                                                    <button class="btn btn-info btn-sm"
                                                                            type="submit">SAVE / PRINT
                                                                    </button>
                                                                    <button class="btn btn-danger btn-sm"
                                                                            data-dismiss="modal" aria-hidden="true"
                                                                            type="button">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        <!--body wrapper end-->


<!-- <script type="text/javascript" src="jquery-1.11.2.min.js"></script> -->
<script>
    function searchFilter(page_num) {
        // page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        // var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'GET',
            url: 'getProduct.php',
            data: '?hal=post&keywords=' + keywords,
            beforeSend: function () {
                $('.loading-overlay').show();
            },
            success: function (html) {
                $('#show_product').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++) if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function kalkulatorTambah(type1, type2) {

        var a = parseInt(type1.replace(/,.*|[^0-9]/g, ''), 10); //eval(type1);
        var b = parseInt(type2.replace(/,.*|[^0-9]/g, ''), 10);
        var hasil = b - a;

        var jumlah = 'Rp. ' + hasil.toFixed(0).replace(/(d)(?=(ddd)+(?!d))/g, "$1.");
        //var total = NilaiRupiah(hasil);
        // console.info('hahah')
        document.getElementById('result').innerHTML = convertToRupiah(hasil);

        document.getElementById("kembalian").value = convertToRupiah(hasil); //document.getElementById("type2").value;

    }

    /* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('type1');
    tanpa_rupiah.addEventListener('keyup', function (e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    var puser = document.getElementById('type2');
    puser.addEventListener('keyup', function (e) {
        puser.value = formatRupiah(this.value);
    });

</script>

            <!--body wrapper end-->
            <!--footer section start-->
            <?php include("footer.php"); ?>
            <!--footer section end-->
        </div>
        <!-- main content end-->
    </section>

    <!-- Placed js at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>

    <script src="assets/js/easypiechart/jquery.easypiechart.js"></script>
    <script src="assets/js/easypiechart/easypiechart-init.js"></script>

    <script src="assets/js/sparkline/jquery.sparkline.js"></script>
    <script src="assets/js/sparkline/sparkline-init.js"></script>

    <script src="js/iCheck/jquery.icheck.js"></script>
    <script src="js/icheck-init.js"></script>

    <script src="assets/js/flot-chart/jquery.flot.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.tooltip.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.resize.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.pie.resize.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.selection.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.stack.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.time.js"></script>
    <script src="assets/js/main-chart.js"></script>
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>


    <script type="text/javascript" src="assets/js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/js/data-tables/DT_bootstrap.js"></script>

    <script src="assets/js/editable-table.js"></script>

    <script src="assets/asseys/js/editable-table.js"></script>

    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/validation-init.js"></script>

    <!-- cart -->
    <?php
    if ($_GET['hal'] == 'dashboard') {
        ?>
        <script src="assets/js/morris-chart/morris.js"></script>
        <script src="assets/js/morris-chart/raphael-min.js"></script>
        <!--
        <script src="assets/js/calendar/clndr.js"></script>
        <script src="assets/js/calendar/evnt.calendar.init.js"></script>
        <script src="assets/js/calendar/moment-2.2.1.js"></script>
        -->
        <script src="assets/js/underscore-min.js"></script>
        <!-- <script src="assets/js/scripts.js"></script>  -->
        <script src="assets/js/dashboard-chart-init-edi.js"></script>
        <!--Dashboard Charts-->

        <?php
    }
    ?>
    <!-- cart -->
    <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="assets/js/pickers-init.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!--file upload-->
    <script type="text/javascript" src="assets/js/bootstrap-fileupload.min.js"></script>
    <!-- <script src="assets/js/edi.js"></script> -->
    <script>
        jQuery(document).ready(function () {
            EditableTable.init();
        });
    </script>

    </body>
    </html>
    <?php
} else {
    header("Location: login.php");
}
?>