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
                                <th>NO ORDER</th>
                                <th>SHIPPING NAME </th>
                                <th>CONSIGNEE </th>
                                <th>VESSEL</th>
                                <th>SHIPPER</th>
                                <th>ADDRESS</th>
                                <th>INVOICE</th>
                                <th width='15%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $row) {
                            ?>
                                <tr>
                                    <td><?= $row['order_number'] ?></td>
                                    <td><?= $row['shipping_name'] ?></td>
                                    <td><?= $row['consignee'] ?></td>
                                    <td><?= $row['vessel'] ?></td>
                                    <td><?= $row['shipper'] ?></td>
                                    <td><?= substr($row['address'], 0, 20) . '...' ?></td>
                                    <td><?= $row['invoice'] ?></td>
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
</script>