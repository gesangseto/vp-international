<?php
$date_now = date("Y-m-d");
$controller = $this->router->fetch_class();
$temp_url = $this->uri->segment(1) . '/' . $controller;

if ($this->session->flashdata('response')) {
    $response = $this->session->flashdata('response');
    $this->session->unset_userdata('response');
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("Sukse Update", "", "success")
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
                    <h1 class="h3 mb-0 text-gray-800">Konfigurasi</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action=" <?= site_url('administrator/configuration/update') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <strong>Data</strong>
                <hr />
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for=""> LOGO</label>
                                <input name="logo" type="file" class="form-control" value="<?= @$form['logo'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nama Perusahaan</label>
                                <small>*</small>
                                <input name="id" required type="hidden" class="form-control" value="<?= @$form['id'] ?>" />
                                <input name="name" required type="text" class="form-control" value="<?= @$form['name'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Alamat</label>
                                <small>*</small>
                                <textarea name="address" class="form-control"><?= @$form['address'] ?></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> TEL</label>
                                <small>*</small>
                                <input name="phone" required type="number" class="form-control" value="<?= @$form['phone'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> FAX</label>
                                <small>*</small>
                                <input name="fax" required type="text" class="form-control" value="<?= @$form['fax'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Email</label>
                                <small>*</small>
                                <input name="email" required type="email" class="form-control" value="<?= @$form['email'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Website</label>
                                <small>*</small>
                                <input name="website" required type="text" class="form-control" value="<?= @$form['website'] ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> NPWP</label>
                                <small>*</small>
                                <input name="npwp" required type="text" class="form-control" value="<?= @$form['npwp'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Siup</label>
                                <small>*</small>
                                <input name="siup" required type="text" class="form-control" value="<?= @$form['siup'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> CEO</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='ceo_name' value="<?= @$form['ceo_name'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> CEO Phone</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='number' name='ceo_phone' value="<?= @$form['ceo_phone'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5>Account Bank</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Bank Name</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='bank_name' value="<?= @$form['bank_name'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Branch</label>
                                <small></small>
                                <div>
                                    <input class="form-control" type='text' name='bank_branch' value="<?= @$form['bank_branch'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Account Name</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='account_name' value="<?= @$form['account_name'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> ACC (IDR) NO</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='account_number_idr' value="<?= @$form['account_number_idr'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> ACC (USD) NO</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='account_number_usd' value="<?= @$form['account_number_usd'] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5>Login Special Admin</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Username</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='text' name='username' value="<?= @$form['username'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Password</label>
                                <small>*</small>
                                <div>
                                    <input class="form-control" required type='password' name='password' value="<?= @$form['password'] ?>" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"> Simpan</button>
                        <a class="btn btn-secondary pull-right" href='<?= site_url() .  $temp_url  ?>'> Batal</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>