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
    <?php
    if (@$data) {
    ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama customer</th>
                                <th>No customer </th>
                                <th>Alamat </th>
                                <th>Kota</th>
                                <th>Distrik</th>
                                <th>Wilayah</th>
                                <th>Negara</th>
                                <th>Kode Pos</th>
                                <th>No Telp </th>
                                <th width='15%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
                            ?>
                                <tr>
                                    <td><?= $row['customer_name'] ?></td>
                                    <td><?= $row['customer_id'] ?></td>
                                    <td><?= substr($row['customer_address'], 0, 20) . '...' ?></td>
                                    <td><?= $row['customer_city'] ?></td>
                                    <td><?= $row['customer_district'] ?></td>
                                    <td><?= $row['customer_region'] ?></td>
                                    <td><?= $row['customer_country'] ?></td>
                                    <td><?= $row['customer_postal_code'] ?></td>
                                    <td><?= $row['customer_phone'] ?></td>
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