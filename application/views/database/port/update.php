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
                    <h1 class="h3 mb-0 text-gray-800">Ubah Port</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action=" <?= site_url('database/port/update') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Kode Port</label>
                                <small>*</small>
                                <input id="" name="id" required placeholder="" type="hidden" class="form-control" value="<?= @$form['id'] ?>" />
                                <input id="" name="port_code" required placeholder="" type="text" class="form-control" value="<?= @$form['port_code'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nama Port</label>
                                <small>*</small>
                                <input id="" name="port_name" required placeholder="" type="text" class="form-control" value="<?= @$form['port_name'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Negara Port</label>
                                <small>*</small>
                                <input id="" name="port_country" required placeholder="" type="text" class="form-control" value="<?= @$form['port_country'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Kode Negara</label>
                                <small>*</small>
                                <input id="" name="port_country_code" required placeholder="" type="text" class="form-control" value="<?= @$form['port_country_code'] ?>" />
                            </div>
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