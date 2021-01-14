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
    if (@$position) {
    ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h1 class="h3 mb-0 text-gray-800">Hak Akses</h1>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kode Posisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($position as $row) {
                            ?>
                                <tr>
                                    <td><?= $row['position_name'] ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td>
                                        <?= $this->tools->action('update', $row['id']) ?>
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