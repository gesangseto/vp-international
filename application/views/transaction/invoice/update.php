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
if ($this->session->flashdata('response')) {
    $response = $this->session->flashdata('response');
    $this->session->unset_userdata('response');
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("Sukse Update Invoice", "", "success")
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
                    <h1 class="h3 mb-0 text-gray-800">Update <?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>TO</label>
                                    <input id="agent_id" name="agent_id" readonly type="hidden" value="<?= @$agent['agent_id'] ?>">
                                    <input id="agent_name" name="agent_name" class="form-control" required onclick="get_agent()" value="<?= @$agent['agent_name'] ?>" type="text" autocomplete="off" placeholder="Seach Agent">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <?php
                                    $address = $agent['agent_address'] . ', ' . $agent['agent_region'] . ', ' . $agent['agent_district'] . ', ' . $agent['agent_city'] . ', ' . $agent['agent_country'] . '. ' . $agent['agent_postal_code'];

                                    ?>
                                    <textarea class="form-control" readonly id="agent_address"><?= @$address ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label>PHONE</label>
                                    <input id="agent_phone" readonly value="<?= @$agent['agent_phone'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>INVOICE NUMBER</label>
                                    <input name="invoice_number" class="form-control" readonly type="text" value="<?= @$invoice[0]['invoice_number'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>INVOICE DATE</label>
                                    <input name="invoice_date" class="form-control" readonly type="text" value="<?= @$invoice[0]['invoice_date'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>SHIPMENT TYPE</label>
                                    <input name="shipment_type" class="form-control" type="text" value="<?= @$invoice[0]['shipment_type'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <br />
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ORDER NO</td>
                                        <td>
                                            <div class="input-group">
                                                <div id="order_number">
                                                    <input id="inp_order_number" name="order_number" required onclick="get_order_number()" value="<?= @$invoice[0]['order_number'] ?>" type="text" class="form-control" autocomplete="off" placeholder="Seach Order No">
                                                    <input id="job_order_id" name="job_order_id" value="<?= @$invoice[0]['job_order_id'] ?>" required type="hidden">
                                                </div>
                                            </div>
                                        </td>
                                        <td>EX VESSEL</td>
                                        <td>
                                            <input readonly id="ex_vessel" type="text" class="form-control" required value="<?= $invoice[0]['vessel'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONTAINER NO</td>
                                        <td>
                                            <input id="container_no" type="text" readonly value="<?= @$invoice[0]['container_no'] ?>" class=" form-control">
                                        </td>
                                        <td>MBL NO</td>
                                        <td>
                                            <input id="mbl_no" readonly class="form-control" type="text" required value="<?= @$invoice[0]['mbl_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HBL NO</td>
                                        <td>
                                            <input readonly id="hbl_no" class="form-control" type="text" required value="<?= @$invoice[0]['hbl_no'] ?>" />
                                        </td>
                                        <td>SHIPPING</td>
                                        <td>
                                            <input readonly id="shipping" class="form-control" type="text" required value="<?= @$invoice[0]['shipper'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ETA</td>
                                        <td>
                                            <input readonly id="eta" class="form-control" type="text" required value="<?= @$invoice[0]['eta'] ?>" />
                                        </td>
                                        <td>CONSIGNE</td>
                                        <td>
                                            <input readonly id="consignee" class="form-control" type="text" required value="<?= @$invoice[0]['consignee'] ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <table class="table" id="table_description">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <td rowspan="2" width="20%">Description</td>
                                                    <td rowspan="2" width="10%">QTY</td>
                                                    <td rowspan="2" width="10%">CURR</td>
                                                    <td rowspan="2" width="10%">Rate</td>
                                                    <td colspan="3" width="40%">IDR</td>
                                                    <td rowspan="2" width="10%">Action</td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                    <td>Amount</td>
                                                    <td>VAT(1%)</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <?php
                                            $total_amount = 0;
                                            $total_vat = 0;
                                            foreach ($invoice as $row) {
                                                $id_row = $row['invoice_id'];

                                                echo  '<input name="invoice_id[]" class="form-control" readonly type="hidden" value="' . @$row['invoice_id'] . '">';
                                                echo '<tr id="row_' . $id_row . '">
                                                <td>
                                                    <div class="autocomplete" style="width:100%;">
                                                        <input id="inp' . $id_row . '" required type="hidden" name="task_id[]" value="' . $row['task_id'] . '">
                                                        <input type="text"class="form-control" readonly value="' . $row['task_name'] . '">
                                                    </div>    
                                                </td> 
                                                <td><input id="quantity' . $id_row . '"  onkeyup="sum_total(\'' . $id_row . '\')"  type="text" class="form-control" required name="quantity[]" class=" form-control" value="' . $row['quantity'] . '"></td>
                                                <td><input id="currency' . $id_row . '" type="text" class="form-control" readonly name="currency[]" class=" form-control" value="IDR"></td>
                                                <td><input id="rate' . $id_row . '" type="text" class="form-control" readonly name="rate[]" class=" form-control" value="' . $row['rate'] . '"></td>
                                                <td><input id="amount' . $id_row . '" type="text" class="form-control" readonly name="amount[]" class=" form-control" value="' . $row['amount'] . '"></td>
                                                <td><input id="vat' . $id_row . '" type="text"class="form-control" readonly name="vat[]" class=" form-control" value="' . $row['vat'] . '"></td>
                                                <td><input id="total' . $id_row . '" type="text" class="form-control" readonly name="total[]" class=" form-control" value="' . $row['total'] . '"></td>
                                                <td style="text-align:center;">
                                                    <a type="button" onclick="delete_row(\'row_' . $id_row . '\')" class="closebtn btn btn-warning"><i class="fas fa-times"></i></a>
                                                </td>
                                            </tr>';
                                                $total_amount += $row['amount'];
                                                $total_vat += $row['vat'];
                                            }
                                            ?>
                                        </table>
                                        <hr />
                                        <table class="table" id="tableTotal">
                                            <thead>
                                                <tr id="" style="text-align: center;">
                                                    <td width="50%"><strong>TOTAL</strong></td>
                                                    <td> <input type="text" id="total_amount" name="total_amount" readonly class="form-control" value="<?= $total_amount ?>"></td>
                                                    <td><input type="text" id="total_vat" name="total_vat" readonly class="form-control" value="<?= $total_vat ?>"></td>
                                                    <td><input type=" text" id="grand_total" name="grand_total" readonly class="form-control" value="<?= @$invoice[0]['grand_total'] ?>"></td>
                                                    <td width="10%"><button type="button" onclick="make_total(1)" class="btn btn-info"><i class="fa fa-calculator"> </button></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./box-header-->
                    <!-- /.box-body -->
                    <hr />
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