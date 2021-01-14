<?php
$date_now = date("Y-m-d");
$controller = $this->router->fetch_class();
$temp_url = $this->uri->segment(1) . '/' . $controller;
if (isset($response)) {
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("' . $response['messages'] . '", "", "success")
        .then((value) => {
            window.location.href ="' . site_url() .  $temp_url . '";
          });
        </script>';
    } else {
        echo '
        <script> swal("' . $response['messages'] . '", "", "error");</script>';
    }
}

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <div class="row">
                <div class="col-md-10">
                    <h1 class="h3 mb-0 text-gray-800">Ubah User</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action=" <?= site_url('administrator/user/update') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <strong>Data</strong>
                <hr />
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nomor Induk Karyawan</label>
                                <small>*</small>
                                <input name="id" type="hidden" value="<?= @$form['id'] ?>" />
                                <input name="employee_no" required type="text" class="form-control" value="<?= @$form['employee_no'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nama Lengkap</label>
                                <small>*</small>
                                <input id="fullname" name="fullname" required placeholder="" type="text" class="form-control" value="<?= @$form['fullname'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> Jenis Kelamin</label>
                            <small>*</small>
                            <select name="gender" class="form-control">
                                <option>Pilih</option>
                                <option value="Male" <?= @$form['gender'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Female" <?= @$form['gender'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> Agama</label>
                            <small>*</small>
                            <select name="religion" class="form-control">
                                <option>Pilih</option>
                                <option value="Islam" <?= @$form['religion'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                <option value="Protestan" <?= @$form['religion'] == 'Protestan' ? 'selected' : '' ?>>Protestan</option>
                                <option value="Katolik" <?= @$form['religion'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                <option value="Hindu" <?= @$form['religion'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                <option value="Buddha" <?= @$form['religion'] == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                <option value="Khonghucu" <?= @$form['religion'] == 'Khonghucu' ? 'selected' : '' ?>>Khonghucu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Tempat Lahir</label>
                            <small>*</small>
                            <input name="pob" required placeholder="" type="text" class="form-control" value="<?= @$form['pob'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Tanggal Lahir</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='date' name='dob' value="<?= @$form['dob'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Email</label>
                            <small>*</small>
                            <input name="email" required type="email" class="form-control" value="<?= @$form['email'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Nomor Handphone</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='number' name='phone_number' value="<?= @$form['phone_number'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Alamat Lengkap</label>
                            <small>*</small>
                            <textarea name="address" required class="form-control"><?= @$form['address'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Posisi</label>
                            <small>*</small>
                            <select required name="position_id" class="form-control">
                                <option selected value="" disabled class="form-control">pilih</option>
                                <?php
                                if ($position)
                                    foreach ($position as $row) { ?>
                                    <option <?= @$form['position_id'] == $row['id'] ? 'selected' : '' ?> value="<?= $row['id'] ?>" class="form-control"><?= $row['position_name'] ?></option>
                                <?php
                                    } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"> Simpan</button>
                    <a class="btn btn-secondary pull-right" href='<?= site_url() .  $temp_url  ?>'> Batal</a>

                </div>
            </form>
        </div>
    </div>
</div>