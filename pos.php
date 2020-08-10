<?php
$id_session = session_id();
$grand_total = $connect->query("SELECT (harga * jumlah) AS TOTAL FROM  
        `barang`
         INNER JOIN `orders_temp` 
          ON (`barang`.`id` = `orders_temp`.`id_barang`)   WHERE orders_temp.id_session='" . $id_session . "'");
$rowGrandTotal = mysqli_fetch_array($grand_total);
?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Daftar Barang
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">

                            <div class="btn-group pull-right">
                            </div>
                        </div>
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama</th>
                                <th width="15%">Harga</th>
                                <th width="15%">Stock</th>
                                <th width="15%">Satuan</th>
                                <!--<th>Deskripsi</th>-->
                                <th width="25%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $queryProduct = $connect->query("SELECT * FROM barang ORDER BY id DESC");
                            while ($rowProduct = mysqli_fetch_array($queryProduct)) {
                                ?>
                                 <tr class="">
                                 	<td><?php echo $no++ ?></td>
                                    <td><?php echo $rowProduct['nmbrg'] ?></td>
                                    <td>Rp. <?php echo number_format($rowProduct['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo $rowProduct['stock'] ?></td>
                                    <td><?php echo $rowProduct['nmsatuan'] ?></td>
                                   <!-- <td><?php echo $rowProduct[''] ?></td>-->
                                    <td>
                                        <a href="?hal=beli_langsung&id=<?php echo $rowProduct['id']; ?>">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"
                                                                                             aria-hidden="true"></i>
                                                Beli Langsung
                                            </button>
                                        </a>
                                        <a href="?hal=master/barang/edit&id=<?php echo $rowProduct['id']; ?>">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-phone"
                                                                                             aria-hidden="true"></i>
                                                Via Telepon
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
    </div>
</div>

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
