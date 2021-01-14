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
                    <h1 class="h3 mb-0 text-gray-800">Read Agent</h1>
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
                            <label for=""> ID Agent</label>
                            <small>*</small>
                            <input name="id" readonly type="hidden" value="<?= @$form['id'] ?>" />
                            <input name="agent_id" readonly type="text" class="form-control" value="<?= @$form['agent_id'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> Nama Agent</label>
                            <small>*</small>
                            <input id="" name="agent_name" readonly placeholder="" type="text" class="form-control" value="<?= @$form['agent_name'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Alamat</label>
                        <small>*</small>
                        <textarea name="agent_address" readonly class="form-control"><?= @$form['agent_address'] ?></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Nomor Telp</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='number' name='agent_phone' value="<?= @$form['agent_phone'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Kota</label>
                        <small>*</small>
                        <input name="agent_city" readonly type="text" class="form-control" value="<?= @$form['agent_city'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Distrik</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='text' name='agent_district' value="<?= @$form['agent_district'] ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Wilayah</label>
                        <small>*</small>
                        <input name="agent_region" readonly type="text" class="form-control" value="<?= @$form['agent_region'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Negara</label>
                        <small>*</small>
                        <div>
                            <input class="form-control" readonly type='text' name='agent_country' value="<?= @$form['agent_country'] ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Kode Pos</label>
                        <small>*</small>
                        <input name="agent_postal_code" readonly type="number" class="form-control" value="<?= @$form['agent_postal_code'] ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <hr>
            <div class="box-footer">
                <a class="btn btn-secondary pull-right" href='<?= site_url() .  $temp_url  ?>'> Batal</a>

            </div>
        </div>
    </div>
</div>