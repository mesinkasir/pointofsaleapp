

<div class="left-side sticky-left-side">
    <!--logo and iconic logo start-->
    <div class="logo">
        
       <!-- <a href="index.php"><img src="assets/images/logo.png" alt=""></a>-->
    </div>

    <div class="logo-icon text-center">
        <!--<a href="index.php"><img src="assets/images/logo_icon.png" alt=""></a>-->
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">
        <!-- visible to small devices only -->
        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <?php $data = url($_GET['hal']); ?>
            <li><a href="?hal=dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="menu-list <?php echo ($data[1] == 'barang' || $data[1] == 'category' || $data[1] == 'satuan' || $data[1] == 'ekspedisi' ) ? 'nav-active' : ''; ?>">
                <a href="#"><i class="fa fa-th-list"></i> <span>Master</span></a>
                <ul class="sub-menu-list">
                    <li <?php echo $data[1] == 'category' ? 'class=active' : ''; ?>><a href="?hal=master/category/list"><i
                                    class="fa fa-list"></i>Kategori</a></li>
                    <li <?php echo $data[1] == 'satuan' ? 'class=active' : ''; ?>><a href="?hal=master/satuan/list"><i
                                    class="fa fa-tachometer"></i>Satuan</a></li>
                    <li <?php echo $data[1] == 'barang' ? 'class=active' : ''; ?>><a href="?hal=master/barang/list"><i
                                    class="fa fa-briefcase"></i> Barang</a></li>
                    <li <?php echo $data[1] == 'ekspedisi' ? 'class=active' : ''; ?>><a href="?hal=master/ekspedisi/list"> <i
                                    class="fa fa-plane"> </i>Ekspedisi</a></li>
                </ul>
            </li>
            <!-- <li><a href="?hal=pos"><i class="fa fa-money"></i> <span>Kasir</span></a></li> -->

            <li class="menu-list <?php echo ($data[1] == 'beli_langsung' || $data[1] == 'via_telepon') ? 'nav-active' : ''; ?>">
                <a href="#"><i class="fa fa-money"></i> <span>Kasir</span></a>
                <ul class="sub-menu-list">
                    <li <?php echo $data[1] == 'beli_langsung' ? 'class=active' : ''; ?>><a
                                href="?hal=beli_langsung"> <i class="fa fa-money"></i>Beli Langsung</a>
                    </li>
                    <li <?php echo $data[1] == 'via_telpon' ? 'class=active' : ''; ?>><a
                                href="?hal=via_telpon"> <i class="fa fa-phone"></i>Via Telpon</a>
                    </li>
                </ul>
            </li>

             <li class="menu-list <?php echo ($data[1] == 'transaksi_langsung' || $data[1] == 'via_telepon') ? 'nav-active' : ''; ?>">
                <a href="#"><i class="fa fa-book"></i> <span>Daftar Transaksi</span></a>
                <ul class="sub-menu-list">
                    <li <?php echo $data[1] == 'transaksi_langsung' ? 'class=active' : ''; ?>><a
                                href="?hal=transaksi_langsung"> <i class="fa fa-money"></i>Transaksi Langsung</a>
                    </li>
                    <li <?php echo $data[1] == 'transaksi_telpon' ? 'class=active' : ''; ?>><a
                                href="?hal=transaksi_telpon"> <i class="fa fa-phone"></i>Transaksi Telpon</a>
                    </li>
                </ul>
            </li>
            <!-- <li><a href="?hal=coming"><i class="fa fa-book"></i> <span> Daftar Transaksi</span></a></li> -->
            <!--<li><a href="?hal=master/transaksi/list"><i class="fa fa-book"></i> <span> Transaksi</span></a></li>-->
            <li class="menu-list <?php echo ($data[1] == 'laporan_product' || $data[1] == 'laporan_stock' || $data[1] == 'laporan_transaksi') ? 'nav-active' : ''; ?>">
                <a href="#"><i class="fa fa-file"></i> <span>Laporan</span></a>
                <ul class="sub-menu-list">
                    <li <?php echo $data[1] == 'laporan_stock' ? 'class=active' : ''; ?>><a
                                href="laporan_product.php" target="_blank"> <i class="fa fa-bar-chart-o"></i>Laporan Product Terlaris</a>
                    </li>
                    <li <?php echo $data[1] == 'laporan_product' ? 'class=active' : ''; ?>><a
                                href="laporan_transaksi_langsung.php" target="_blank"> <i class="fa fa-bar-chart-o"></i>Laporan Transaksi Langsung</a>
                    </li>
                    <li <?php echo $data[1] == 'laporan_transaksi' ? 'class=active' : ''; ?>><a
                                href="laporan_transaksi_telepon.php" target="_blank"> <i class="fa fa-bar-chart-o"></i>Laporan
                            Transaksi Telepon Lunas</a></li>
                    <li <?php echo $data[1] == 'laporan_transaksi' ? 'class=active' : ''; ?>><a
                                href="laporan_transaksi_pending.php" target="_blank"> <i class="fa fa-bar-chart-o"></i>Laporan
                            Transaksi Telepon Pending</a></li>
                </ul>
            </li>
            <li><a href="logout.php"><i class="fa fa-sign-in"></i> <span>Logout</span></a></li>
        </ul>
        <!--sidebar nav end-->
    </div>
</div>
<!-- https://demo.dealpos.com/A/POS.aspx -->