<?php


include "config.php";


function isi_keranjang()
{
	include "config.php";

session_start();
if(!isset($_SESSION['id_session'])){
    $ids = date("YmdHis");
    $_SESSION['id_session'] = $ids;
}

    $isikeranjang = array();
    $id_session=$_SESSION['id_session'];
    $sql = $connect->query("SELECT * FROM keranjang WHERE id_session='$id_session'");

    while ($r = mysqli_fetch_array($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}



$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);

// var_dump($jml);

if ($jml == 0) {
    echo "<script> alert('Product masih kosong'); location.href='jual.php' </script>";
    exit();
}

//$tgl_skrg = date("Y-m-d");
$jam_skrg = date("H:i:s");


// simpan data pemesanan

//exit();
// mendapatkan nomor orders

// TIMEZONE
date_default_timezone_set("Asia/Jakarta");
$date= date("ymd");

// mencari kode barang dengan nilai paling besar
$query = "SELECT max(id_orders) as maxKode FROM orders_detail";
$hasil = $connect->query($query);
$data = mysqli_fetch_array($hasil);
$kodePesan = $data['maxKode'];
 
// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodePesan, 9, 3);
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;
 
// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "TP";
// $tahun=substr($date, 0, 4);
// $bulan=substr($date, 5, 2);
// $hari=substr($date, 6, 2);
$kodePesanan = $char.$date.sprintf("%03s", $noUrut);

$id_orders = $kodePesanan;
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan


$jam_skrg = date("H:i:s");
// simpan data detail pemesanan
for ($i = 0; $i < $jml; $i++) {
    $connect->query("INSERT INTO orders_detail(id_orders, product_id, jumlah, tgl_order, jam_order) 
                   VALUES('$id_orders',{$isikeranjang[$i]['id_barang']}, {$isikeranjang[$i]['qty']}, NOW(), '$jam_skrg')");

    $connect->query("UPDATE barang SET stock=stock - {$isikeranjang[$i]['qty']}, total_terjual =  total_terjual+{$isikeranjang[$i]['qty']} WHERE id={$isikeranjang[$i]['id_barang']}");


}
//exit();
for ($i = 0; $i < $jml; $i++) {

    $connect->query("DELETE FROM keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");
}
//exit();
$daftarproduk = $connect->query("SELECT orders_detail.id_orders, orders_detail.product_id,  orders_detail.jumlah, barang.nmbrg, barang.id, barang.kdbrg, barang.stock, barang.harga FROM orders_detail JOIN barang ON  orders_detail.product_id = barang.id  WHERE id_orders='$id_orders'");
//exit();
?>
<!--header start -->

<!-- header end -->

<script>

function printPage(id)
{
   var html="<html>";
   html+= document.getElementById(id).innerHTML;

   html+="</html>";

   var printWin = window.open('','','left=0,top=0,width=600,height=600,toolbar=0,scrollbars=0,status  =0');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
}
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<div id="print">
<div class="wrapper" style="margin: 0 auto; padding: 20px; width: 350px; font-weight: normal;">
         <div id="struk">
         <div cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">
         <center> <img src="assets/images/topos.png" class="img-fluid"/>
                            <br>
                            <small> https://mesinkasironline.web.app <br>
                                wa : +6285646104747 <br>
                                call : +6281259444676<br>
                               <?php echo $id_orders; ?></small> <br/>
<small><?php echo date("Y-m-d") . "-" . date("H:i:s"); ?></small>
<hr>
</center>
</div>

	<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">
                       <tbody>                          
                            <?php

                        //exit();
                        $CetakNota = $connect->query("SELECT * FROM orders_detail,barang 
                                     WHERE orders_detail.product_id=barang.id 
                                     AND id_orders='$id_orders'");
                        $totalcetak = 0;
                        $itemcetak = 0;
                        while ($datacetak = mysqli_fetch_array($CetakNota)) {
                            $subtotalcetak = +$datacetak['jumlah'] * $datacetak['harga'];
                            $totalcetak += $subtotalcetak;
                            $itemcetak += $datacetak['jumlah'];
                            ?>
                            <tr>
                             <td width="50%"><strong>Item</strong></td>
                             <td class="text-center" width="10%"><strong>Qty</strong></td>
                             <td width="40%" class="text-right"><strong>Total</strong></td>
                             
                             </tr>
               
                        <tr>
                       <td width="50%"><?php echo $datacetak['nmbrg']; ?></td>
                                <td class="text-center" width="10%">
                                    <?php echo $datacetak['jumlah']; ?>
                                </td>
                                <td width="40%" class="text-right">
                                    Rp. <?php echo number_format($subtotalcetak, 0, ',', '.'); ?></td>
                        </tr>
                         <?php
                        }
                        ?>
<!--<tr>
                            <td>Jumlah Items</td>
                            <td><?php echo $itemcetak; ?></td>
                            <td></td>
                        </tr>-->
                
                         <tr class="text-right">
                                            <td colspan="2"><strong>TOTAL</strong></td>
                            <td><strong>Rp. <?php echo number_format($totalcetak, 0, ',', '.'); ?> </td>
                            </strong></tr>
                        <tr class="text-right">
                        <td colspan="2"><strong>PAYMENT</strong></td>
                        <td><strong>
                        Rp. <?php echo number_format(str_replace(".", "", $_POST['cash']), 0, ',', '.'); ?></td>
                        </strong></tr>
                        <tr class="text-right">
                            <td colspan="2"><strong>CHANGE</strong></td>
                            <td>
                            <strong>Rp. <?php
                                $kembali = str_replace(".", "", $_POST['cash']) - $totalcetak;
                                echo number_format($kembali, 0, ',', '.');
                                ?></strong>
                            </td>
                        </tr>
                      </tbody>
                    </table>
<!--                    <div cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;"><center>Terima Kasih</center></div>-->
            </div>
            </div>
            </div>

            <center>
            <input type="button" class="btn btn-primary" value="Receipt Print" onclick="printPage('print');"></input>
            &nbsp; <a href="jual.php" class="btn btn-info">Back to Web Apps</a></center>
<!--<form method="post" action="struct.php" target="blank">
                                            <input type="hidden" name="cash" value="<?php echo $_POST['cash']; ?>">

                                            <input type="hidden" name="id_orders" value="<?php echo $id_orders; ?>">

                                            <input type="hidden" name="id_session" value="<?php echo $id_session; ?>">
                                                                                   <!--<button class="btn btn-primary" type="submit" name="simpan">
                                                <i class="fa fa-print"></i> PRINT NOTA
                                            </button>-->

<!--<button> <a href="jual.php"> APPs<button></a>
                                            </center>
                                           
                                        
     </form>-->

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
