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
$controller = $this->router->fetch_class();
$temp_url = $this->uri->segment(1) . '/' . $controller;
if ($this->session->flashdata('response')) {
    $response = $this->session->flashdata('response');
    $this->session->unset_userdata('response');
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("Sukse Update request Cash Advanced", "", "success")
        .then((value) => {
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
                    <h1 class="h3 mb-0 text-gray-800"><?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
                </div>
                <div class="col-md-2">
                    <!-- <a href="<?= site_url() ?>pengaturan_sistem/pengaturan_bahasa" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-left-arrow fa-sm text-white-50"></i> Kembali</a> -->
                </div>
            </div>
        </div>
        <form class="form-horizontal" action="<?= site_url() .  $temp_url ?>/update" method="post" id="employeeform">

            <div class="card-body">
                <div class="box box-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ADVANCE FROM</td>
                                        <td>
                                            <input name="id" readonly type="hidden" class="form-control" required value="<?= @$form['id'] ?>" />
                                            <input name="advance_from" readonly type="text" class="form-control" required value="<?= @$form['advance_from'] ?>" />
                                        </td>
                                        <td>RECEIPT NO</td>
                                        <td>
                                            <input name="receipt_no" readonly type="text" class="form-control" required value="<?= @$form['receipt_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ORDER NO</td>
                                        <td>
                                            <div class="input-group">
                                                <div id="order_number">
                                                    <input id="inp_order_number" readonly name="order_number" required value="<?= @$form['order_number'] ?>" type="text">
                                                </div>
                                            </div>
                                        </td>
                                        <td>EX VESSEL</td>
                                        <td>
                                            <input readonly name="ex_vessel" id="ex_vessel" type="text" class="form-control" required value="<?= @$form['ex_vessel'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONTAINER NO</td>
                                        <td>
                                            <input readonly id="container_no" type="text" name="container_no" value="<?= @$form['container_no'] ?>" class=" form-control">
                                        </td>
                                        <td>MBL NO</td>
                                        <td>
                                            <input readonly id="mbl_no" name="mbl_no" class="form-control" type="text" required value="<?= @$form['mbl_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HBL NO</td>
                                        <td>
                                            <input readonly name="hbl_no" id="hbl_no" class="form-control" type="text" required value="<?= @$form['hbl_no'] ?>" />
                                        </td>
                                        <td>SHIPPING</td>
                                        <td>
                                            <input readonly name="shipping" id="shipping" class="form-control" type="text" required value="<?= @$form['shipping'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ETA</td>
                                        <td>
                                            <input readonly name="eta" id="eta" class="form-control" type="text" required value="<?= @$form['eta'] ?>" />
                                        </td>
                                        <td>CONSIGNE</td>
                                        <td>
                                            <input readonly name="consignee" id="consignee" class="form-control" type="text" required value="<?= @$form['consignee'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <td>
                                            <input name="status" readonly id="status" class="form-control" type="text" required value="<?= @$form['status'] ? $form['status'] : 'Pending' ?>" />
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--./box-header-->
                    <!-- /.box-body -->
                    <hr />
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <h4 class="box-title" id="customControlInline"> Details</h4>
                                </label>
                            </div>
                        </div>
                        <div class="">
                            <div class="feebox">
                                <table class="table3" id="tableID" border="1">
                                    <tr style="text-align: center;">
                                        <td rowspan="2">DESCRIPTION</td>
                                        <td colspan="2">CASH ADVANCE</td>
                                        <td rowspan="2"></td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td>IDR</td>
                                        <td>USD</td>
                                    </tr>
                                    <?php foreach ($form_detail as $row) { ?>
                                        <tr id="row0">
                                            <input required type="hidden" value="<?= $row['id'] ?>" name="id_detail[]">

                                            <td width="20%">
                                                <div class="autocomplete" style="width:100%;">
                                                    <input id="inp0" required type="text" class="back-of-everything" value="<?= $row['task_id'] ?>" name="task_id[]">
                                                    <input id="view0" required type="text" name="task_name[]" readonly value="<?= $row['task_name'] ?>">
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <input type="text" id="ca_idr_amount" name="ca_idr[]" value="<?= $row['ca_idr'] ?>" class="form-control">
                                            </td>
                                            <td width="10%">
                                                <input type="text" id="ca_usd_amount" name="ca_usd[]" value="<?= $row['ca_usd'] ?>" class="form-control">
                                            </td>
                                            <td width="5%"></td>
                                        </tr>

                                    <?php
                                    } ?>
                                </table>
                                <hr />
                                <table class="tableTotal" id="tableTotal" border="1">
                                    <tr id="" style="text-align: center;">
                                        <td width="20%"><strong>TOTAL</strong></td>
                                        <td width="15%"><input type="text" id="total_ca_idr" name="total_ca_idr" readonly class="form-control inp" value="<?= @$form['total_ca_idr'] ?>"></td>
                                        <td width="10%"><input type="text" id="total_ca_usd" name="total_ca_usd" readonly class="form-control inp" value="<?= @$form['total_ca_usd'] ?>"></td>
                                        <td width="5%"><button type="button" onclick="add_allowance()" class="btn btn-info"><i class="fa fa-calculator" /> </button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--./col-md-4-->
                    <!--./col-md-4-->
                    <div class="col-md-12 col-sm-12">
                        <br />
                        <button type="submit" name="submit" id="contact_submit" class="btn btn-info pull-right"> Simpan</button>

                        <a href="#" onclick="window.location.replace(' <?= site_url() . $temp_url  ?>');" class="btn btn-default pull-right"> Kembali</a>
                    </div>
                    <!--./col-md-12-->
                </div>
            </div>
        </form>
    </div>
</div>
<div id="content_list_task"></div>

<script src="<?= base_url() ?>assets/ajax/3.4.1/jquery.min.js"></script>


<script type="text/javascript">
    function add_allowance() {
        var ca_idr = document.getElementsByName('ca_idr[]');
        var ca_usd = document.getElementsByName('ca_usd[]');

        var total_ca_idr = 0;
        var total_ca_usd = 0;

        for (var i = 0; i < ca_idr.length; i++) {
            var inp_ca_idr = ca_idr[i].value ? ca_idr[i].value : 0;
            var inp_ca_usd = ca_usd[i].value ? ca_usd[i].value : 0;

            total_ca_idr += +parseFloat(inp_ca_idr).toFixed(3);
            total_ca_usd += +parseFloat(inp_ca_usd).toFixed(3);
        }
        $("#total_ca_idr").val(total_ca_idr);
        $("#total_ca_usd").val(total_ca_usd);

    }
</script>