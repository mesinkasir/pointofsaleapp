<?php
error_reporting(0);
$id = $_GET['id'];
$queryRowCategory = $connect->query("SELECT * FROM category where category_id = '" . $id . "'");
$rowCategory = mysqli_fetch_array($queryRowCategory);
if (isset($_POST['ubah'])) {
    $queryUpdate = $connect->query("UPDATE category SET  category_name = '" . $_POST['category_name'] . "', category_status = '" . $_POST['category_status'] . "' WHERE category_id = '" . $id . "' ");

}
if ($queryUpdate) {
    echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/category/list' </script>";
    exit;
}

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
    <div class="col-12 col-md-3 p-3 p-md-5"></div>
<div class="col-12 col-md-6 p-3 p-md-5">
<img width="200" class="img-fluid" src="assets/images/cat.png"/>       
            <section class="panel">
                <header class="panel-heading">
                    UPDATE CATEGORIES
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action="">
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-12" style="text-align: left;">Categories</label>
                                <div class="col-lg-12">
                                    <input class="form-control" id="cname" name="category_name" minlength="2"
                                           type="text" value="<?php echo $rowCategory['category_name'] ?>" required/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-12"
                                       style="text-align: left;">Status</label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="category_status">
                                        <option value="Y">Active</option>
                                        <option value="N">Not Active</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- update asli -->
                                    <input type="submit" value="UPDATE" class="uk-button uk-button-primary" name="ubah">
                                    <!--  <button class="btn btn-primary" type="submit" name="ubah">UPDATE</button> -->
                                    <a href="?hal=master/category/list">
                                        <button class="uk-button uk-button-default" type="button">CANCEL</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-12 col-md-3 p-3 p-md-5"></div>
    </div>
</div>
<!--body wrapper end-->