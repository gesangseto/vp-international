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
                    <h1 class="h3 mb-0 text-gray-800">Tambah Job Order</h1>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action=" <?= site_url('transaction/job_order/create') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""> Order No</label>
                            <div class="input-group">
                                <div id="order_number">
                                    <input name="order_number" readonly type="text" class="form-control" value="<?= @$form['order_number'] ?>" />
                                </div>
                                <div class="input-group-btn">
                                    <a class="btn btn-default" onclick="renewOrderNumber(<?= $date_now ?>)" id="renew_icon">
                                        <i class="fa fa-retweet"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""> Nama Agent</label>
                                <small>*</small>
                                <input id="" name="agent_name" required placeholder="" type="text" class="form-control" value="<?= @$form['agent_name'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Alamat</label>
                            <small>*</small>
                            <textarea name="agent_address" required class="form-control"><?= @$form['agent_address'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Nomor Telp</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='number' name='agent_phone' value="<?= @$form['agent_phone'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Kota</label>
                            <small>*</small>
                            <input name="agent_city" required type="text" class="form-control" value="<?= @$form['agent_city'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Distrik</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='text' name='agent_district' value="<?= @$form['agent_district'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Wilayah</label>
                            <small>*</small>
                            <input name="agent_region" required type="text" class="form-control" value="<?= @$form['agent_region'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Negara</label>
                            <small>*</small>
                            <div>
                                <input class="form-control" required type='text' name='agent_country' value="<?= @$form['agent_country'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Kode Pos</label>
                            <small>*</small>
                            <input name="agent_postal_code" required type="number" class="form-control" value="<?= @$form['agent_postal_code'] ?>" />
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

<script src="<?= base_url() ?>assets/ajax/3.4.1/jquery.min.js"></script>
<script>
    function renewOrderNumber(date) {
        $('#order_number').html('<input name="order_number" readonly type="text" class="form-control" placeholder="please wait..." />');
        $('#renew_icon').html('<i class = "fa fa-spinner"/>');

        $.ajax({
            type: 'POST',
            url: '<?= site_url("transaction/Ajax_data/renew_order_number") ?>',
            data: {
                date: date,
            },
            success: function(isi) {
                $('#order_number').html(isi);
                $('#renew_icon').html('<i class = "fa fa-retweet"/>');
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(thrownError); // Munculkan alert error
            }
        });
    }
</script>