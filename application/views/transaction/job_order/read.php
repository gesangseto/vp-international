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
                    <h1 class="h3 mb-0 text-gray-800"><?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
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
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ORDER NO</td>
                                        <td>
                                            <div class="input-group">
                                                <div id="order_number">
                                                    <input name="order_number" class="form-control" readonly type="text" required value="<?= @$form['order_number'] ?>" />
                                                </div>
                                                <div class="input-group-btn">
                                                    <a class="btn btn-default" onclick="renewOrderNumber('dummy')" id="renew_icon">
                                                        <i class="fa fa-retweet"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SHIPPING NAME</td>
                                        <td>
                                            <input name="shipping_name" type="text" class="form-control" required value="<?= @$form['shipping_name'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONSIGNEE</td>
                                        <td>
                                            <input name="consignee" class="form-control" type="text" required value="<?= @$form['consignee'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>VESSEL</td>
                                        <td>
                                            <input name="vessel" class="form-control" type="text" required value="<?= @$form['vessel'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SHIPPER</td>
                                        <td>
                                            <input name="shipper" class="form-control" type="text" required value="<?= @$form['shipper'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONTAINER NO</td>
                                        <td>
                                            <textarea name="container_no" class="form-control"><?= @$form['container_no'] ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PARTY</td>
                                        <td>
                                            <input name="party" class="form-control" type="text" required value="<?= @$form['party'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MBL NO</td>
                                        <td>
                                            <input name="mbl_no" class="form-control" type="text" required value="<?= @$form['mbl_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HBL NO</td>
                                        <td>
                                            <input name="hbl_no" class="form-control" type="text" required value="<?= @$form['hbl_no'] ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <?php
                                        $invoice = substr(@$form['order_number'], -5);
                                        ?>
                                        <td>INVOICE</td>
                                        <td>
                                            <div id="invoice">
                                                <input name="invoice" class="form-control" readonly type="text" required value="<?= @$form['invoice'] . 'A/' . $invoice . 'B/' . $invoice . 'C' ?>" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td>
                                            <input name="date" type="date" class="form-control" required value="<?= @$form['date'] ? @$form['date'] : $date ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ETD</td>
                                        <td>
                                            <input name="etd" class="form-control" type="month" required value="<?= @$form['etd'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ETA</td>
                                        <td>
                                            <input name="eta" class="form-control" type="month" required value="<?= @$form['eta'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>POL</td>
                                        <td>
                                            <input name="pol" class="form-control" type="text" required value="<?= @$form['pol'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>POD</td>
                                        <td>
                                            <input name="pod" class="form-control" type="text" required value="<?= @$form['pod'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                            <textarea name="address" class="form-control"><?= @$form['address'] ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FREIGHT</td>
                                        <td>
                                            <input name="freight" class="form-control" type="text" required value="<?= @$form['freight'] ?>" />
                                        </td>
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
                        <?php
                        if ($form_detail) {
                        ?>
                            <div class="">
                                <div class="feebox">
                                    <table class="table3" id="tableID" border="1">
                                        <tr style="text-align: center;">
                                            <td rowspan="2">DESCRIPTION</td>
                                            <td colspan="2">BUYING</td>
                                            <td colspan="2">SELLING</td>
                                            <td colspan="2">PROFIT</td>
                                            <td></td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <td>IDR</td>
                                            <td>USD</td>
                                            <td>IDR</td>
                                            <td>USD</td>
                                            <td>IDR</td>
                                            <td>USD</td>
                                            <td><button type="button" for="customControlInline" onclick="add_more()" class="btn btn-success"><i class="fas fa-plus"></i></button></td>
                                        </tr>
                                        <?php
                                        foreach ($form_detail as $row) {
                                        ?>
                                            <tr id="row0">
                                                <td width="20%">
                                                    <div class="autocomplete" style="width:auto;">
                                                        <input value="<?= $row['task_name'] ?>" type="text">
                                                    </div>
                                                </td>

                                                <td width="15%">
                                                    <input type="text" readonly class=" form-control inp" value="<?= $row['buying_idr'] ?>">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" readonly class=" form-control inp" value="<?= $row['buying_usd'] ?>">
                                                </td>
                                                <td width="15%">
                                                    <input type="text" readonly class=" form-control inp" value="<?= $row['selling_idr'] ?>">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" readonly class=" form-control inp" value="<?= $row['selling_usd'] ?>">
                                                </td>
                                                <td width=" 15%">
                                                    <input type="text" readonly class=" form-control inp" value="<?= $row['profit_idr'] ?>">
                                                </td>
                                                <td width=" 10%">
                                                    <input type="text" readonlyi class=" form-control inp" value="<?= $row['profit_usd'] ?>">
                                                </td>
                                                <td width=" 5%">
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <hr />
                                    <table class="tableTotal" id="tableTotal" border="1">
                                        <tr id="" style="text-align: center;">
                                            <td width="20%"><strong>TOTAL</strong></td>
                                            <td width="15%"><input type="text" name="total_buying_idr" readonly class="form-control inp" value="<?= @$form_detail[0]['total_buying_idr'] ?>"></td>
                                            <td width="10%"><input type="text" name="total_buying_usd" readonly class="form-control inp" value="<?= @$form_detail[0]['total_buying_usd'] ?>"></td>
                                            <td width="15%"><input type="text" name="total_selling_idr" readonly class="form-control inp" value="<?= @$form_detail[0]['total_selling_idr'] ?>"></td>
                                            <td width="10%"><input type="text" name="total_selling_usd" readonly class="form-control inp" value="<?= @$form_detail[0]['total_selling_usd'] ?>"></td>
                                            <td width="15%"><input type="text" name="total_profit_idr" readonly class="form-control inp" value="<?= @$form_detail[0]['total_profit_idr'] ?>"></td>
                                            <td width="10%"><input type="text" name="total_profit_usd" readonly class="form-control inp" value="<?= @$form_detail[0]['total_profit_usd'] ?>"></td>
                                            <td width="5%"><button type="button" onclick="add_allowance()" class="btn btn-info"><i class="fa fa-calculator" /> </button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php } else {
                            echo 'NOT FOUND';
                        } ?>
                    </div>
                    <!--./col-md-4-->
                    <!--./col-md-4-->
                    <div class="col-md-12 col-sm-12">
                        <br />
                        <button type="submit" name="submit" id="contact_submit" class="btn btn-info pull-right"> Simpan</button>
                    </div>
                    <!--./col-md-12-->
                </div>
            </div>
        </form>
    </div>
</div>