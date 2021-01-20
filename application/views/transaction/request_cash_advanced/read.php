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
                    <h1 class="h3 mb-0 text-gray-800">Read customer</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <strong>Data</strong>
            <hr />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> ID customer</label>
                            <small>*</small>
                            <input name="id" readonly type="hidden" value="<?= @$form['id'] ?>" />
                            <input name="customer_id" readonly type="text" class="form-control" value="<?= @$form['customer_id'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> Nama customer</label>
                            <small>*</small>
                            <input id="" name="customer_name" readonly placeholder="" type="text" class="form-control" value="<?= @$form['customer_name'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Alamat</label>
                        <small>*</small>
                        <textarea name="customer_address" readonly class="form-control"><?= @$form['customer_address'] ?></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Nomor Telp</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='number' name='customer_phone' value="<?= @$form['customer_phone'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Kota</label>
                        <small>*</small>
                        <input name="customer_city" readonly type="text" class="form-control" value="<?= @$form['customer_city'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Distrik</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='text' name='customer_district' value="<?= @$form['customer_district'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Wilayah</label>
                        <small>*</small>
                        <input name="customer_region" readonly type="text" class="form-control" value="<?= @$form['customer_region'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Negara</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='text' name='customer_country' value="<?= @$form['customer_country'] ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Kode Pos</label>
                        <small>*</small>
                        <input name="customer_postal_code" readonly type="number" class="form-control" value="<?= @$form['customer_postal_code'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</div>