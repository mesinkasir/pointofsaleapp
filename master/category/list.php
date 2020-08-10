<?php
if (isset($_GET['hapus'])) {
   // $queryHapus = mysql_query("DELETE FROM category where category_id = '" . $_GET['hapus'] . "'");
    $queryHapus = $connect->query("DELETE FROM category where category_id = '" . $_GET['hapus'] . "'");
    if ($queryHapus) {
        echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/category/list' </script>";
        exit;
    }
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
<div class="row">
        <div class="col-12 col-md-5">
            <section class="panel">
                <header class="panel-heading">
                <img class="img-fluid" src="assets/images/cat.png"/>
                <h3>PRODUCT CATEGORY</h3>
                            </div>
            
                        <div class="col-12 col-md-7 p-3 p-md-3">
                     
                </header>
              <a href="?hal=master/category/add">
                                    <button data-toggle="modal" class="uk-button uk-button-primary">
                                        Add new Categories
                                    </button>
                                </a><hr/>
                        <table class="table" id="editable-sample">
                            <thead>
                            <tr class="bg-light">
                                <th>Categories</th>
                                <th>Status</th>
                                <th>Set</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 0;
                            //$queryCategory = mysql_query("SELECT * FROM category ORDER BY category_id DESC");
                            $queryCategory = $connect->query("SELECT * FROM category ORDER BY category_id DESC");
                            while ($rowCategory = mysqli_fetch_array($queryCategory)) {
                                ?>
                                <tr class="">

                                    <td><?php echo $rowCategory['category_name']; ?></td>
                                    <td><?php if ($rowCategory['category_status'] == 'Y') { ?>
                                            <button class="uk-button uk-button-success" type="submit">
                                            Active
                                            </button>
                                        <?php } else { ?>
                                            <button class="uk-button uk-button-danger" type="submit"><i class="fa fa-ban"></i> Not
                                                Active
                                            </button>

                                        <?php } ?></td>
                                    <td>


                                        <a href="?hal=master/category/edit&id=<?php echo $rowCategory['category_id']; ?>">
                                            <button class="uk-button uk-button-primary" type="submit"><i class="fa fa-edit"></i>
                                                Edit
                                            </button>
                                        </a>
                                        <a href="?hal=master/category/list&hapus=<?php echo $rowCategory['category_id']; ?>">
                                            <button class="uk-button uk-button-danger" type="submit" name="hapus">
                                             Delete
                                            </button>
                                        </a>
                                        <!-- user -->
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
