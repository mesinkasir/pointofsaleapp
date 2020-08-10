<?php
error_reporting(0);
$id = $_GET['id'];
$queryRowUser = mysql_query("SELECT * FROM user WHERE user_id = '" . $id . "'");
$rowUser = mysql_fetch_array($queryRowUser);
$level_users = $rowUser['user_level'] == 'super admin' ? 'super admin' : $_POST['user_level'];
if (isset($_POST['ubah'])) {

    if (!empty($_FILES) && $_FILES['user_foto']['size'] > 0 && $_FILES['user_foto']['error'] == 0) {
        $random = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $foto = $random . $_FILES['user_foto']['name'];
        $move = move_uploaded_file($_FILES['user_foto']['tmp_name'], 'assets/images/user/' . $foto);
        if ($move) {
            $queryUpdate = mysql_query("UPDATE user SET 
                                            user_foto = '" . $foto . "',
                                            user_name = '" . $_POST['user_name'] . "',
                                            user_username = '".$_POST['user_username']."',
                                            user_level = '" . $level_users . "',
                                            user_status = '" . $_POST['user_status'] . "'
                                            WHERE user_id = '" . $id . "'
                                             ");
            $file = "assets/images/user/" . $rowUser['user_foto'];
            unlink($file);
        }
    } else {
        $queryUpdate = mysql_query("UPDATE user SET 
                                            user_name = '" . $_POST['user_name'] . "',
                                            user_level = '" . $level_users . "',
                                            user_status = '" . $_POST['user_status'] . "'
                                            WHERE user_id = '" . $id . "'
                                             ");

    }

    if ($queryUpdate) {
        echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/user/list' </script>";
        exit;
    }
}


if (isset($_POST['updatePassword'])) {
    if (!empty($_POST['user_password'])) {
        $queryUpdate = mysql_query("UPDATE user SET
                                                user_password = '" . password_hash($_POST['user_password'], PASSWORD_DEFAULT) . "'
                                                WHERE user_id = '" . $_POST['user_id'] . "'");
    }else{
        echo "<script> alert('Password tidak diubah'); location.href='index.php?hal=master/user/list' </script>";
        exit;
    }

    if ($queryUpdate) {
        echo "<script> alert('Password Berhasil diubah'); location.href='index.php?hal=master/user/list' </script>";
        exit;

    }
}

?>
<section class="panel">
    <header class="panel-heading">
        ADD USER
    </header>
    <div class="panel-body">
        <div class=" form">
            <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST"
                  enctype="multipart/form-data" action="">
                <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nama </label>
                    <div class="col-lg-7">
                        <input class=" form-control" id="cname" name="user_name"  type="text"
                               value="<?php echo $rowUser['user_name'] ?>"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Foto</label>
                    <div class="col-lg-7">
                        <img src="assets/images/user/<?php echo $rowUser['user_foto']; ?>" width="20%">
                        <input class=" form-control" id="cname" name="user_foto" type="file"
                               value="<?php echo $rowUser['user_foto'] ?>"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nama </label>
                    <div class="col-lg-7">
                        <input class=" form-control" id="cname" name="user_username" type="text"
                               value="<?php echo $rowUser['user_username'] ?>"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Password</label>
                    <div class="col-lg-7"> ***************************
                        <i class="fa fa-pencil pull-right" data-toggle="modal" data-target="#myModal"
                           style="color: #424f63;"></i>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Level</label>
                    <div class="col-lg-7">
                        <select name="user_level" class="form-control ">
                            <option value="">--pilih level--</option>
                            <?php if ($rowUser['user_level'] == 'admin') { ?>
                                <option value="admin" selected="">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="manager">Manager</option>
                            <?php } elseif ($rowUser['user_level'] == 'kasir') { ?>
                                <option value="admin">Admin</option>
                                <option value="kasir" selected="">Kasir</option>
                                <option value="manager">Manager</option>
                            <?php } elseif ($rowUser['user_level'] == 'manager') { ?>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="manager" selected="">Manager</option>
                            <?php }else{ ?>
                                <option value="admin">Admin</option>
                                <option value="manager">Kasir</option>
                                <option value="manager" selected="">Manager</option>
                           <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Status</label>
                    <div class="col-lg-3">
                        <select name="user_status" class="form-control ">
                            <option value="">-- status --</option>
                            <?php
                            if ($rowUser['user_status'] == 'Y') {
                                ?>
                                <option value="Y" selected="">Active</option>
                                <option value="N">Not Active</option>
                                <?php
                            } else {
                                ?>
                                <option value="Y">Active</option>
                                <option value="N">Not Active</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-7">
                        <button class="btn btn-primary" type="submit" name="ubah">Save</button>
                        <a href="?hal=master/user/list">
                            <button class="btn btn-default" type="button">Cancel</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
</div>
</div>
</div>
<!--body wrapper end-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> Ganti Password</h4>
            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label" style="text-align: left;">Password
                            Baru</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="user_id" value="<?php echo $rowUser['user_id']; ?>">
                            <input class="form-control" name="user_password"
                                   type="password">
                        </div>
                    </div>
                    <div class="pull-right">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" name="updatePassword" type="submit"><i
                            class="fa fa-check-square-o"></i> OK
                </button>
                <button class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true" type="button"><i
                            class="fa fa-times"></i> Cancel
                </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- start modal end -->