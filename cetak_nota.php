<?php

include_once("config.php");

$id_orders = @$_POST['id_orders'] ;


?>


	<div class="col-md-7">
		<div id="struk">
			 <div style="width:487px; 
                padding:0 10px 20px 10px; 
                margin:0 auto; 
                background:#ffffff; color:#4d4d4d;
                 font:13px /1.5 Tahoma; border:4px double #dddddd;">


<script>
function printPage(id)
{
   var html="<html>";
   html+= document.getElementById(id).innerHTML;

   html+="</html>";

   var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status  =0');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
}
</script>


				<table cellpadding="0" cellspacing="0" border="0">
                        <tbody>

                        <tr align="center">
                            <td valign="top"
                                style="width:150px; padding:10px 0; border-bottom:4px double #dddddd;text-align: center;">
                                <!-- <h1>LOGO</h1> -->
                                <img src="assets/images/topos.png" class="img-fluid"/>
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
                                
                            </td></tr>
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
