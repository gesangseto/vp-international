<style>
    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
</style>

<!-- SWAL Fire -->
<?php
$date_now = date("Y-m-d");
$controller = $this->router->fetch_class();
$temp_url = $this->uri->segment(1) . '/' . $controller;
if ($this->session->flashdata('statusCode')) {
    if ($this->session->flashdata('statusCode') == '200') {
        $this->session->unset_userdata('statusCode');
        $this->session->unset_userdata('messages');
        echo '<script>
        swal("' . $this->session->flashdata('messages') . '", "", "success");
        </script>';
    } else {
        echo '
        <script> swal("' . $this->session->flashdata('messages') . '", "", "error");</script>';
        $this->session->unset_userdata('statusCode');
        $this->session->unset_userdata('messages');
    }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left">
                <h1 class="h3 mb-0 text-gray-800">Manajemen Hak Akses</h1>
            </div>
            <div class="float-right">
                <a data-toggle="modal" data-target="#create_permission" class="btn btn-success"></i>Tambah Hak Akses</a>
            </div>
        </div>
        <div class="card-body">
            <?php
            if ($permission) {
            ?>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <a class="btn btn-primary" href="<?= site_url('Uac_user/Create') ?>">Add Admin</a> -->
                    </div>
                    <div class="col-md-8">
                    </div>

                    <div class="col-md-12">
                        <br>
                        <?php
                        // var_dump($menu);
                        foreach ($permission as $row) {
                            echo '<br>';
                            echo '<strong>' . $row['menu_name'] . '</strong>';
                            echo '<hr>';
                        ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Fitur</th>
                                        <th>create</th>
                                        <th>read</th>
                                        <th>update</th>
                                        <th>delete</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    @$no = 1;
                                    ?>
                                    <?php
                                    foreach ($row['children'] as $chil) {
                                    ?> <tr>
                                            <td><?= $chil['child_name'] ?></td>
                                            <td><input type="checkbox" <?= $chil['create'] == 1 ? 'checked' : '' ?> disabled></td>
                                            <td><input type="checkbox" <?= $chil['read'] == 1 ? 'checked' : '' ?> disabled></td>
                                            <td><input type="checkbox" <?= $chil['update'] == 1 ? 'checked' : '' ?> disabled></td>
                                            <td><input type="checkbox" <?= $chil['delete'] == 1 ? 'checked' : '' ?> disabled></td>
                                            <td>
                                                <button onclick="hapus(<?= $chil['id'] ?>,<?= $_GET['id'] ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <a data-toggle="modal" onclick="showModal(<?= $chil['id'] ?> , <?= $_GET['id'] ?> )" data-target="#modal_update" class="btn btn-warning"></i>manage permission</a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        <?php
                            $no++;
                        } ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>

<div class="modal" id="create_permission">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Hak Akses</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('administrator/permission/create') ?>" method="POST">
                    <input type="text" name="position_id" hidden value="<?= $position['id'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group-addon">Access
                            </div>
                            <select name="uac_child_menu_id" required class="form-control" required>
                                <option value="" disabled selected>-Pilih-</option>
                                <?php
                                foreach ($menu as $row_parent) {
                                    echo '<optgroup label="' . $row_parent['menu_name'] . '">';
                                    foreach ($row_parent['children'] as $row_access) {
                                        echo '<option value="' . $row_access['id'] . '">' . $row_access['child_name'] . '</option>';
                                    }
                                    echo '</li>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="checkbox-group">
                                <input type="checkbox" name="create" value="1"> Create
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="checkbox-group">
                                <input type="checkbox" name="read" value="1"> Read
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="checkbox-group">
                                <input type="checkbox" name="update" value="1"> Update
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="col-md-3">
                            <label class="checkbox-group">
                                <input type="checkbox" name="delete" value="1"> Delete
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
                        <button class="btn btn-lg btn-danger btn-block" type="button" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div id="modal_update" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="<?= site_url() . $temp_url ?>/update" method="POST">
                <div class="modal-header">
                    Ubah Hak Akses
                    <div class="spinner-border" id="loading-image"></div>
                </div>
                <div class="modal-body" id="dataModal">
                    <!-- data modal -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showModal(uid, position_id) {
        $('#loading-image').show();
        $('#dataModal').html('');
        $.ajax({
            type: "POST", // Method pengiriman data bisa dengan GET atau POST
            url: "<?= site_url() ?>administrator/Ajax_data/get_permission", // Isi dengan url/path file php yang dituju
            data: {
                id: uid,
                position_id: position_id
            },
            success: function(isi) {
                $('#dataModal').html(isi);
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(thrownError); // Munculkan alert error
            },
            complete: function() {
                $('#loading-image').hide();
            }
        });
    }

    function hapus(uid, position_id) {
        swal({
                title: "Anda yakin ingin menghapus?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= site_url() . $temp_url ?>/delete?id=" + uid + "&position_id=" + position_id;
                }
            });
    }
</script>