<?php
error_reporting(0);
$id = $_GET['id'];
$queryRowCategory = $connect->query("SELECT * FROM satuan where id_satuan = '" . $id . "'");
$rowCategory = mysqli_fetch_array($queryRowCategory);
if (isset($_POST['ubah'])) {
    $queryUpdate = $connect->query("UPDATE satuan SET  nmsatuan = '" . $_POST['nmsatuan'] . "' WHERE id_satuan = '" . $id . "'");

}
if ($queryUpdate) {
    echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/satuan/list' </script>";
    exit;
}

?>
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
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
    <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <section class="panel">
                <header class="panel-heading">
                
                <img class="img-fluid" src="assets/images/unit.png"/>
                    EDIT UNIT'S
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action="">

                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-12" style="text-align: left;">Unit Name</label>
                                <div class="col-lg-12">
                                    <input class="form-control" id="cname" name="nmsatuan" minlength="2"
                                           type="text" value="<?php echo $rowCategory['nmsatuan'] ?>" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- update asli -->
                                    <input type="submit" value="UPDATE" class="uk-button uk-button-primary" name="ubah">
                                    <!--  <button class="btn btn-primary" type="submit" name="ubah">UPDATE</button> -->
                                    <a href="?hal=master/satuan/list">
                                        <button class="uk-button uk-button-default" type="button">CANCEL</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
<!--body wrapper end-->