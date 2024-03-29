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
                    <h1 class="h3 mb-0 text-gray-800">Pendaftaran Customer</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action=" <?= site_url('master/customer/create') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <strong>Data</strong>
                <hr />
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> ID Customer</label>
                                <small>*</small>
                                <input name="customer_id" required type="text" class="form-control" value="<?= @$form['customer_id'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nama Customer</label>
                                <small>*</small>
                                <input id="" name="customer_name" required placeholder="" type="text" class="form-control" value="<?= @$form['customer_name'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Alamat</label>
                            <small>*</small>
                            <textarea name="customer_address" required class="form-control"><?= @$form['customer_address'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Nomor Telp</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='number' name='customer_phone' value="<?= @$form['customer_phone'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Kota</label>
                            <small>*</small>
                            <input name="customer_city" required type="text" class="form-control" value="<?= @$form['customer_city'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Distrik</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='text' name='customer_district' value="<?= @$form['customer_district'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Wilayah</label>
                            <small>*</small>
                            <input name="customer_region" required type="text" class="form-control" value="<?= @$form['customer_region'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Negara</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='text' name='customer_country' value="<?= @$form['customer_country'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Kode Pos</label>
                            <small>*</small>
                            <input name="customer_postal_code" required type="number" class="form-control" value="<?= @$form['customer_postal_code'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
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