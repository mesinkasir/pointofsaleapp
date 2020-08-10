<?php
/**if (isset($_POST['simpan'])) {
    if (!empty($_FILES) && $_FILES['product_images']['size'] > 0 && $_FILES['product_images']['error'] == 0) {
        $random = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $images = $random . $_FILES['product_images']['name'];
        $move = move_uploaded_file($_FILES['product_images']['tmp_name'], 'assets/images/product/' . $images);

        if ($move) {
            $queryInsert = mysql_query("INSERT INTO product (product_name,
                product_price,product_desc,product_images,product_stock,product_date,category_id)
                 VALUES ('" . $_POST['product_name'] . "',
                         '" . str_replace(".", "", $_POST['product_price']) . "',
                         '" . $_POST['product_desc'] . "',
                         '" . $images . "',
                         '" . $_POST['product_stock'] . "',
                         NOW(),
                         '" . $_POST['product_category'] . "')");
        } else {
            $queryInsert = mysql_query("INSERT INTO product (product_name,
                product_price,product_desc,product_stock,product_date,category_id)
                 VALUES ('" . $_POST['product_name'] . "',
                         '" . str_replace(".", "", $_POST['product_price']) . "',
                         '" . $_POST['product_desc'] . "',
                         '" . $_POST['product_stock'] . "',
                         NOW(),
                         '" . $_POST['product_category'] . "')");
        }
    }
    if ($queryInsert) {
        echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/product/list' </script>";
        exit;
    }
}



*/
//TIMEZONE
// date_default_timezone_set("Asia/Jakarta");
// $date= date("Y-m-d");

// // mencari kode barang dengan nilai paling besar
// $query = "SELECT max(kdbrg) as maxKode FROM barang";
// $hasil = $connect->query($query);
// $data = mysqli_fetch_array($hasil);
// $kodeBarang = $data['maxKode'];
 
// // mengambil angka atau bilangan dalam kode anggota terbesar,
// // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// // misal 'BRG001', akan diambil '001'
// // setelah substring bilangan diambil lantas dicasting menjadi integer
// $noUrut = (int) substr($kodeBarang, 9, 3);
 
// // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
// $noUrut++;
 
// // membentuk kode anggota baru
// // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// // misal sprintf("%03s", 12); maka akan dihasilkan '012'
// // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
// //$char = "BRG";
// $tahun=substr($date, 0, 4);
// $bulan=substr($date, 5, 2);
// $kodeBarang = $char .$tahun .$bulan .$hari . sprintf("%03s", $noUrut);
//echo $kodeBarang;
?>
<!--body wrapper start-->
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
<div class="wrapper">
<div class="row">
        <div class="col-12 col-md-6">
            <section class="panel">
                <header class="panel-heading">
                <img class="img-fluid" src="assets/images/db.png"/>
                <h3>PRODUCT DATABASED</h3>
                            </div>
                            <div class="col-12 col-md-6 p-3 p-md-5">
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" method="POST" enctype="multipart/form-data"
                              action="">
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-12" style="text-align: left;">Barcode</label>
                                <div class="col-lg-12">
                                    <input class=" form-control" id="cname" name="kode_barang" minlength="2"  
                                           type="text" required  />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-12" style="text-align: left;">Product Name</label>
                                <div class="col-lg-12">
                                    <input class=" form-control" id="cname" name="nama_barang" minlength="2"
                                           type="text" required/>
                                </div>
                            </div>
<!--

                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2" style="text-align: left;">Foto</label>

                                <!-- master footo startv -->
                              <!--  <div class="col-md-5">
                                    <div class="fileupload fileupload-new" data-provides="fileupload"><input
                                                type="hidden">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                 alt="">
                                        </div>
                                       <!-- <div class="fileupload-preview fileupload-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>-->
                                      <!--  <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i
                                                               class="fa fa-undo"></i> Change</span>
                                                   <input type="file" name="product_images" class="default">
                                                   </span>
                                            <a href="#" class="btn btn-danger fileupload-exists"
                                               data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>-->
                                <!-- master foto end
                            </div>-->

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-12"
                                       style="text-align: left;">Category</label>
                                <div class="col-lg-12">
                                    <select name="product_category" class="form-control ">
                                        <option value="">Select Categories</option>
                                        <?php
                                        $no = 0;
                                        //$queryCategory = mysql_query("SELECT * FROM category ORDER BY category_id DESC");
                                        $queryCategory = $connect->query("SELECT * FROM category WHERE category_status = 'Y' ORDER BY category_id DESC");
                                        while ($rowCategory = mysqli_fetch_array($queryCategory)) {
                                            ?>
                                            <option value="<?php echo $rowCategory['category_id']; ?>"><?php echo $rowCategory['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-12"
                                       style="text-align: left;">Sell Price </label>
                                <div class="col-lg-12">
                                    <input class="form-control " id="tanpa-rupiah" type="text" name="harga_barang"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-12" style="text-align: left;">Stock</label>
                                <div class="col-lg-6">
                                    <input class="form-control " id="tanpa-rupiah" type="text" name="product_stock"/>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-12"
                                       style="text-align: left;">Unit of product</label>
                                <div class="col-lg-12">
                                    <select name="satuan" class="form-control ">
                                        <option value="">Select Unit</option>
                                        <?php
                                        $no = 0;
                                        //$queryCategory = mysql_query("SELECT * FROM category ORDER BY category_id DESC");
                                        $queryCategory = $connect->query("SELECT * FROM satuan ORDER BY id_satuan DESC");
                                        while ($rowCategory = mysqli_fetch_array($queryCategory)) {
                                            ?>
                                            <option value="<?php echo $rowCategory['id_satuan']; ?>"><?php echo $rowCategory['nmsatuan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2"
                                       style="text-align: left;">Deskripsi</label>
                                <div class="col-lg-5">
                                    <textarea class="form-control " id="ccomment" name="product_desc"
                                              required></textarea>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button class="uk-button uk-button-primary" type="submit" name="simpan" value="simpan">Save</button>
                                    <a href="?hal=master/barang/list">
                                        <button class="uk-button uk-button-danger" type="button">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </form>

<?php
$kode_barang = @$_POST['kode_barang'];
$nama_barang = @$_POST['nama_barang'];
$kategori = @$_POST['product_category'];
$harga_barang = @$_POST['harga_barang'];
$stock = @$_POST['product_stock'];
$satuan = @$_POST['satuan'];

$simpan = @$_POST['simpan']; 

if($simpan){
    $sql = "INSERT INTO barang (kdbrg, nmbrg, harga, stock, tanggal, category_id, id_satuan, total_terjual) VALUES ('$kode_barang','$nama_barang', '$harga_barang', '$stock', NOW(), '$kategori', '$satuan', '')";
         if($connect->query($sql) === TRUE){
           echo "<script> alert('Data Berhasil Di Simpan'); location.href='index.php?hal=master/barang/list' </script>";
       }else{
                      echo "ERROR INPUT DATA =" .$sql->connect_error;
                    }
}
?>

                    </div>

                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
