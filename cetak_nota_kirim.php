<?php

include_once("config.php");

		$id_orders = htmlspecialchars($_POST['id_orders']);
        $id_session = htmlspecialchars($_POST['id_session']);
        $id_customer = htmlspecialchars($_POST['id_customer']);
        $cash = htmlspecialchars($_POST['cash']);
        $ekspedisi = htmlspecialchars($_POST['ekspedisi']);
       
$daftarproduk = $connect->query("SELECT * 
    FROM customer  
    WHERE  id_customer = '$id_customer'
    ");


$lihat = mysqli_fetch_array($daftarproduk);

?>


	<div class="col-md-7">
		<div id="struk">
			 <div style="width:487px; 
                padding:0 10px 20px 10px; 
                margin:0 auto; 
                background:#ffffff; color:#4d4d4d;
                 font:13px /1.5 Tahoma; border:4px double #dddddd;">
				<table cellpadding="0" cellspacing="0" border="0">
                        <tbody>

                        <tr align="center">
                            <td valign="top"
                                style="width:150px; padding:10px 0; border-bottom:4px double #dddddd;text-align: center;">
                                <img src="assets/images/putih.jpg" alt="" style="width: 100%; height: auto;"/>
                            </td>


                            <td colspan="2" valign="top"
                                style="width:340px; padding:10px 0; border-bottom:4px double #dddddd; text-align:center; font-size:15px; line-height:16px;     padding-top: 20px;">
                               TOKO SALSA (OLEH-OLEH HAJI & UMROH)<br>
                                Jl. LANTAI 3 A, BLOK F 36, NO 07 <br>
                                KEBON KACANG RAYA, KB MELATI, <BR>
                                TANAH ABANG, JAKARTA BARAT, DKI JAKARTA<br>
                                TLP. 0813-1535-8266<br>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" valign="top" style="width:100px; padding:10px 0 0 0; font-size:15px; ">
                               No Nota : <?php echo $id_orders; ?> </td>
                             <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:15px; "> KASIR : ADMIN
                          
                            </td>
                            
                        </tr>
                            <?php

                        //exit();
                        $CetakNota = $connect->query("SELECT order_telepon.id_orders, order_telepon.product_id,  order_telepon.jumlah, barang.nmbrg, barang.id, barang.kdbrg, barang.stock, barang.harga FROM order_telepon JOIN barang ON  order_telepon.product_id = barang.id  WHERE id_orders='$id_orders'");
                        $totalcetak = 0;
                        $itemcetak = 0;
                        while ($datacetak = mysqli_fetch_assoc($CetakNota)) {
                            $subtotalcetak = +$datacetak['jumlah'] * $datacetak['harga'];
                            $totalcetak += $subtotalcetak;
                            $itemcetak += $datacetak['jumlah'];
                            ?>
                        <tr>

                                <td valign="top"
                                    style="width:100px; padding:10px 0 0 0; font-size:15px; "><?php echo $datacetak['nmbrg']; ?></td>
                                <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:15px; ">
                                    <?php echo $datacetak['jumlah']; ?>
                                </td>
                                <td style="font-size:15px; text-align: right;">
                                    Rp. <?php echo number_format($subtotalcetak, 0, ',', '.'); ?></td>
                        </tr>
                         <?php
                        }
                        ?>
                        <tr>
                            <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:15px; ">Jumlah Items</td>
                            <td valign="top"
                                style="width:100px; padding:10px 0 0 0;font-size:15px; "><?php echo $itemcetak; ?></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td></td>
                            <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:15px; ">Netto</td>
                            <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: right; ">
                                Rp. <?php echo number_format($totalcetak, 0, ',', '.'); ?> </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:15px; ">Cash</td>
                            <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:15px;text-align: right; ">
                                Rp. <?php echo number_format(str_replace(".", "", $_POST['cash']), 0, ',', '.'); ?></td>
                        </tr>
                        <tr><td colspan="3" valign="top"
                                style="text-align: center;width:100px; border-bottom:1px; padding:10px 0 0 0;font-size:15px; ">
                                
                            </td></tr>
                        <tr>
                            <td></td>
                            <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:15px; ">Kembali</td>
                            <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:15px;text-align: right;">
                               Rp. <?php
                                $kembali = str_replace(".", "", $_POST['cash']) - $totalcetak;
                                echo number_format($kembali, 0, ',', '.');
                                ?>
                            </td>
                        </tr>
                        <tr><td colspan="3" valign="top"
                                style="text-align: center;width:100px; border-bottom:0px; padding:10px 0 0 0;font-size:15px; "><br><br><br>
                                
                            </td>
                        </tr>

                        <tr>
                            <td valign="top"
                               style="width:100px; padding:3px 0 0 0;font-size:15px;">
                                Nama Pembeli: 
                            </td>
                            <td colspan="2" valign="top"
                                style="width:100px; font-size:15px;text-align: left; ">
                                <?php echo $lihat['nama_pembeli']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"
                               style="width:100px; padding:3px 0 0 0;font-size:15px;">
                                Alamat Lengkap:
                            </td>
                            <td valign="top"
                                style="width:100px; padding:2px 0 0 0;font-size:15px;text-align: left; ">
                                <?=$lihat['alamat_pembeli'];?>, <?=$lihat['kelurahan'];?>
                            </td>
                            <td  valign="top"
                                style="width:100px; padding:2px 0 0 0;font-size:15px;text-align: left; ">
                                <?=$lihat['kecamatan'];?>
                            </td>
                        </tr>
                        <tr>
                            <td  valign="top"
                               style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: left; ">
                            </td>
                             <td  valign="top"
                                style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: left; ">
                                <?=$lihat['kabkot'];?>
                            </td>
                            <td  valign="top"
                                style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: left; ">
                                <?=$lihat['prov'];?>
                            </td>
                            
                        </tr>

                        <tr>
                            <td  valign="top"
                                style="width:100px; padding:3px 0 0 0;font-size:15px;">
                                <?php
                                    $sqlEksped = $connect->query("SELECT nmekspedisi FROM ekspedisi WHERE id_ekspedisi = '$ekspedisi'");
                                    $dataEksped = mysqli_fetch_array($sqlEksped);
                                 ?>
                                Ekspedisi: <?=$dataEksped['nmekspedisi'];?>
                            </td>
                             <td  valign="top"
                                style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: left; ">
                                No Telepon:
                            </td> 
                            <td  valign="top"
                                style="width:100px; padding:10px 0 0 0;font-size:15px;text-align: left; ">
                                <?=$lihat['no_telepon'];?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3" valign="top"
                                style="text-align: center;width:100px; padding:10px 0 0 0;font-size:15px; ">
                                ***************<?php echo date("Y-m-d") . "-" . date("H:i:s"); ?>**************
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center;font-size:15px; ">BARANG YANG SUDAH DIBELI</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center;font-size:15px; ">TIDAK DAPAT
                                DITUKAR/DIKEMBALIKAN
                            </td>
                        </tr>

                        </tbody>
                    </table>
			</div>
		</div>
	</div>
