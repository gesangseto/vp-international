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
                <h1 class="h3 mb-0 text-gray-800">List Customer</h1>
            </div>
            <div class="float-right"><?= $this->tools->action('create') ?></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table id="table" class="display table table-hover" style="font-size: 12px;" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address </th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>District</th>
                            <th>Region</th>
                            <th>Country</th>
                            <th>Postal Code</th>
                            <th width='15%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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

<script type="text/javascript">
    var table;
    var url = window.location.href
    $(document).ready(function() {
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('Datatables/get_customer') ?>",
                "type": "POST",
                "data": {
                    "url": url
                },
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });

    });
</script>