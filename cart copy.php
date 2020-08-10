<?php
include "config.php";
include "tanggal.php";

$input=$_GET['input'];
$id_session=$_GET['id_session'];
$id_barang=$_GET['id_barang'];



if($input=="add"){
    $sid = session_id();
    $sql = $connect->query("SELECT stock FROM barang WHERE id='$id_barang'");
    $s = mysqli_fetch_array($sql);
    $stok = $s['stock']; 
    //echo $stok; exit();

    if ($stok == 0) {
         echo "<script> alert('stock habis'); location.href='index.php?hal=beli_langsung' </script>";
         exit();
    } else {
    $query=$connect->query("SELECT id_barang, qty from keranjang where id_barang='$id_barang' and id_session='$id_session'");
    $data_tmp=mysqli_fetch_array($query);
    $cek=mysqli_num_rows($query);
    $qty = $data_tmp['qty'];
    

    if($cek==0){
        $connect->query("INSERT INTO keranjang(id_barang,id_session,tgl_keranjang,jam_keranjang,qty) VALUES ('$id_barang','$id_session','$tgl_sekarang','$jam_sekarang','1')");
    }
    else if($qty >= $stok){

        echo "<script> alert('Stock yang tersedia tidak cukup'); location.href='index.php?hal=beli_langsung' </script>";
                exit();
    }
    else{
        $connect->query("UPDATE keranjang SET qty=qty+1 where id_session='$id_session' and id_barang='$id_barang'");
    }
    header('location:index.php?hal=beli_langsung');
    }
}

// session_start();
// //error_reporting(0);
// include "config.php";
// include "tanggal.php";
// $mod = $_GET['mod'];
// $act = $_GET['act'];


// if ($mod == 'basket' AND $act == 'add') {
//     $sid = session_id();
//     $sql = $connect->query("SELECT stock FROM barang WHERE id='$_GET[id]'");
//     $s = mysqli_fetch_array($sql);
//     $stok = $s['stock']; 
//     //echo $stok; exit();

//     if ($stok == 0) {
//          echo "<script> alert('stock habis'); location.href='index.php?hal=pos' </script>";
//          exit();
//     } else {

//         $sql_temp = $connect->query("SELECT * FROM orders_temp WHERE id_barang='$_GET[id]' AND id_session='$sid'");
//         $data_tmp=mysqli_fetch_array($sql_temp);
//         $ketemu = mysqli_num_rows($sql_temp);
//         if(!empty($data_tmp['stok_temp'])) {
//             if ($data_tmp['jumlah'] >= $stok)  {
//                 echo "<script> alert('Jumlah yang dibeli sedang kosong'); location.href='index.php?hal=pos' </script>";
//                 exit();
//             }
//         }

//         if ($ketemu == 0) {
//             // put the product in cart table
//             $connect->query("INSERT INTO orders_temp (id_barang, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
// 				VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
//         } else {
//             // update product quantity in cart table
//             $connect->query("UPDATE orders_temp 
// 		        SET jumlah = jumlah + 1
// 				WHERE id_session ='$sid' AND id_barang='$_GET[id]'");
//         }
//         deleteAbandonedCart();
//         echo "<script> alert('Product berhasil dibeli'); location.href='index.php?hal=pos' </script>";
//         exit;
//     }
// } elseif ($mod == 'basket' AND $act == 'del') {
//     $connect->query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
//     echo "<script> alert('Product berhasil dihapus'); location.href='index.php?hal=pos' </script>";
//     exit;
// }


// /*
// 	Delete all cart entries older than one day
// */
// function deleteAbandonedCart()
// {
//     $kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
//     mysqli_query ("DELETE FROM orders_temp HERE tgl_order_temp < '$kemarin'");
   
// }

?>
