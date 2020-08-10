<?php
include 'config.php';

        $id_orders = htmlspecialchars($_POST['id_orders']);
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kabkot = htmlspecialchars($_POST['kabkot']);
        $provinsi = htmlspecialchars($_POST['provinsi']);
        $pengiriman = htmlspecialchars($_POST['pengiriman']);
        $no = htmlspecialchars($_POST['no']);
        $jam_skrg = date("H:i:s");

        // var_dump($id_orders);echo "<br>";
        // var_dump($nama);echo "<br>";
        // var_dump($alamat);echo "<br>";
        // var_dump($kelurahan);echo "<br>";
        // var_dump($kecamatan);echo "<br>";
        // var_dump($kabkot);echo "<br>";
        // var_dump($provinsi);echo "<br>";
        // var_dump($pengiriman); echo "<br>";
        // var_dump($no);echo "<br>";
        // var_dump($jam_skrg);echo "<br>";

        $sql = $connect->query("UPDATE order_telepon SET nama_pembeli = '$nama', alamat_pembeli = '$alamat', kelurahan = '$kelurahan', kecamatan = '$kecamatan', kabkot = '$kabkot', prov = '$provinsi', id_ekspedisi = '$pengiriman', no_telepon = '$no', tgl_order = NOW(), jam_order = '$jam_skrg'  WHERE id_orders='$id_orders'");

        if($sql === TRUE){
               echo "<script> alert('Mencetak Nota'); location.href='cetak_kirim.php?id_orders=<?php $id_orders; ?>'' </script>";exit;
           }
        

        ?>