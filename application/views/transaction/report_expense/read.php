<style>
    .inp {
        border: none;
        padding: 5px 10px;
        outline: none;
    }

    [placeholder]:focus::-webkit-input-placeholder {
        transition: text-indent 0.4s 0.4s ease;
        text-indent: -100%;
        opacity: 1;
    }

    .border-class {
        border: thin whitesmoke solid;
        /* margin: 5px; */
        padding: 10px;
        /* height: 400; */
    }

    .back-of-everything {
        position: absolute;
        z-index: -1000;
    }
</style>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font: 16px Arial;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=text] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>
<?php
$date = date("Y-m-d");
@$data_staff = $data_staff['data'][0];
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
                    <h1 class="h3 mb-0 text-gray-800">Lihat Pengeluaran</h1>
                </div>
                <div class="col-md-2">
                    <!-- <a href="<?= site_url() ?>pengaturan_sistem/pengaturan_bahasa" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-left-arrow fa-sm text-white-50"></i> Kembali</a> -->
                </div>
            </div>
        </div>
        <form class="form-horizontal" action="<?= site_url() .  $temp_url ?>/create" method="post" id="employeeform">

            <div class="card-body">
                <div class="box box-primary">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Bulan</label>
                            <input name="year_month" class="form-control" type="month" required value="<?= @$form['year_month'] ?>" />
                        </div>
                        <div class="col-md-6">
                            <label>Tipe Pengeluaran</label>
                            <select required name="mst_expense_id" class="form-control">
                                <option selected disabled>--Pilih--</option>
                                <?php
                                foreach ($expense as $row) {
                                ?>
                                    <option <?= @$row['id'] == @$form['mst_expense_id'] ? 'selected' : '' ?> value="<?= @$row['id'] ?>"><?= @$row['expense_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Total</label>
                            <input name="total" class="form-control" type="number" required value="<?= @$form['total'] ?>" />
                        </div>
                        <div class="col-md-6">
                            <label>Catatan</label>
                            <input name="note" class="form-control" type="text" required value="<?= @$form['note'] ?>" />
                        </div>
                    </div>
                    <!--./col-md-4-->
                    <!--./col-md-4-->
                    <div class="col-md-12 col-sm-12">
                        <br />
                    </div>
                    <!--./col-md-12-->
                </div>
            </div>
        </form>
    </div>
</div>