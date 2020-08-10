<?php
if (isset($_POST['simpan'])) {
    if (!empty($_FILES) && $_FILES['user_foto']['size'] > 0 && $_FILES['user_foto']['error'] == 0) {
        $random = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $foto = $random . $_FILES['user_foto']['name'];
        $move = move_uploaded_file($_FILES['user_foto']['tmp_name'], 'assets/images/user/' . $foto);
        $queryInsert = mysql_query(
            $sql = "INSERT INTO user
                (user_foto,
                  user_name,
                  user_username,
                  user_password,
                  user_level,
                  user_create_date,
                  user_status)
                 VALUES ('" . $foto . "',
                 '" . $_POST['user_name'] . "',
                 '" . $_POST['user_username'] . "',
                 '" . password_hash($_POST['user_password'], PASSWORD_DEFAULT) . "',
                 '" . $_POST['user_level'] . "',NOW(),
                 '" . $_POST['user_status'] . "')");
    } else {
        $queryInsert = mysql_query(
            $sql = "INSERT INTO user (
                user_name,
                user_username,
                user_password,
                user_level,
                user_create_date,
                user_status)
                 VALUES ('" . $_POST['user_name'] . "',
                 '" . $_POST['user_username'] . "',
                 '" . password_hash($_POST['user_password'], PASSWORD_DEFAULT) . "',
                 '" . $_POST['user_level'] . "',NOW(),
                 '" . $_POST['user_status'] . "')");
    }
    if ($queryInsert) {
        echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/user/list' </script>";
        exit;
    }
}
?>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
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
                                    <input class=" form-control" id="cname" name="user_name" type="text" required/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Foto</label>
                                <div class="col-md-7">
                                    <div class="fileupload fileupload-new" data-provides="fileupload"><input
                                                type="hidden">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                 alt="">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                        <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i
                                                               class="fa fa-undo"></i> Change</span>
                                                   <input type="file" name="user_foto" class="default">
                                                   </span>
                                            <a href="#" class="btn btn-danger fileupload-exists"
                                               data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Username</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" id="cname" name="user_username" type="text" required/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Password</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" name="user_password" type="password" required/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Level</label>
                                <div class="col-lg-7">
                                    <select name="user_level" required="" class="form-control ">
                                        <option value="">--pilih level--</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Status</label>
                                <div class="col-lg-3">
                                    <select name="user_status" required="" class="form-control ">
                                        <option value="">-- status --</option>
                                        <option value="Y">Active</option>
                                        <option value="N">Not Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-7">
                                    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
                                    <button class="btn btn-default" type="button">Cancel</button>
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