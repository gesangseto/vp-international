<!-- SWAL Fire -->

<?php
$controller = $this->router->fetch_class();
$temp_url = $this->uri->segment(1) . '/' . $controller;
if (isset($response)) {
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("' . $response['messages'] . '", "", "success")
        .then((value) => {
            window.location.href ="' . site_url() . $temp_url . '";
          });
        </script>';
    } else {
        echo '
        <script> swal("' . $response['messages'] . '", "", "error");</script>';
    }
}
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left">
                <h1 class="h3 mb-0 text-gray-800">Filter</h1>
            </div>
            <!-- <div class="float-right"></div> -->
        </div>

        <div class="card-body">
            <form method='POST'>
                <div class="row">
                    <div class="col-md-10">
                        <span>Cari Kata Kunci</span>
                        <input name="search" class="form-control" value="<?= @$form['search'] ?>" />
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button class="btn btn-primary btn-block"> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php
    if (@$data) {
    ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Advnc From</th>
                                <th>No Recpt </th>
                                <th>Odr No </th>
                                <th>Vessel</th>
                                <th>Cntnr No</th>
                                <th>Mbl No</th>
                                <th>Hbl No</th>
                                <th>Shppng</th>
                                <th>Eta </th>
                                <th>Cnsgn</th>
                                <th>Req Loc</th>
                                <th>Stts</th>
                                <th width='15%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
                            ?>
                                <tr>
                                    <td><?= $row['advance_from'] ?></td>
                                    <td><?= $row['receipt_no'] ?></td>
                                    <td><?= $row['order_number'] ?></td>
                                    <td><?= $row['ex_vessel'] ?></td>
                                    <td><?= $row['container_no'] ?></td>
                                    <td><?= $row['mbl_no'] ?></td>
                                    <td><?= $row['hbl_no'] ?></td>
                                    <td><?= $row['shipping'] ?></td>
                                    <td><?= $row['eta'] ?></td>
                                    <td><?= $row['consignee'] ?></td>
                                    <td><?= $row['request_location'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <?= $this->tools->action('read', $row['id']) ?>
                                        <?= $this->tools->action('update', $row['id']) ?>
                                        <?= $this->tools->action('delete', $row['id']) ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php

    }
    ?>
</div>
</div>

<!-- /.container-fluid -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js">
</script>
<script>
    function hapus(uid) {
        swal({
                title: "Anda yakin ingin menghapus?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= site_url() . $temp_url ?>/delete?id=" + uid;
                }
            });
    }

    $(document).ready(function() {
        $("#province").change(function() {
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?= site_url() ?>administrator/ajax_data/get_regency", // Isi dengan url/path file php yang dituju
                data: {
                    province_id: $("#province").val()
                },
                success: function(isi) {
                    $('#regency').html(isi);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(thrownError); // Munculkan alert error
                }
            });
        });
        $("#regency").change(function() {
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?= site_url() ?>administrator/ajax_data/get_district", // Isi dengan url/path file php yang dituju
                data: {
                    regency_id: $("#regency").val()
                },
                success: function(isi) {
                    $('#district').html(isi);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(thrownError); // Munculkan alert error
                }
            });
        });
        $("#district").change(function() {
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?= site_url() ?>administrator/ajax_data/get_village", // Isi dengan url/path file php yang dituju
                data: {
                    district_id: $("#district").val()
                },
                success: function(isi) {
                    $('#village').html(isi);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>