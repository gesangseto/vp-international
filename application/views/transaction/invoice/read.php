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
                    <h1 class="h3 mb-0 text-gray-800">Read <?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
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
                            <label>JOB SHEETS NO</label>
                            <input name="job_sheets_id" readonly type="text" value="<?= $_GET['id'] ?>">
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <br />
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="tablist" role="tablist">
                                <?php
                                for ($i = 0; $i < count($job_order); $i++) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $i == 0 ? 'active' : '' ?>" id="tab<?= $i ?>" data-toggle="tab" href="#content_tab<?= $i ?>" role="tab" aria-controls="tab<?= $i ?>" aria-selected="true">Sheet <?= $i + 1 ?></a>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>

                            <div class="tab-content" id="tabcontentlist">
                                <?php
                                for ($i = 0; $i < count($job_order); $i++) { ?>
                                    <div class="tab-pane fade show <?= $i == 0 ? 'active' : '' ?>" id="content_tab<?= $i ?>" role="tabpanel" aria-labelledby="content_tab<?= $i ?>">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>ORDER NO</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div id="order_number">
                                                                <input id="inp_order_number_<?= $i ?>" name="order_number[<?= $i ?>]" required onclick="get_order_number('inp_order_number_<?= $i ?>',<?= $i ?>)" type="text" autocomplete="off" value="<?= $job_order[$i]['order_number'] ?>">
                                                                <input id="job_order_id_<?= $i ?>" name="job_order_id[<?= $i ?>]" required type="hidden">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>EX VESSEL</td>
                                                    <td>
                                                        <input readonly name="ex_vessel[<?= $i ?>]" id="ex_vessel_<?= $i ?>" type="text" class="form-control" required value="<?= $job_order[$i]['vessel'] ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CONTAINER NO</td>
                                                    <td>
                                                        <input id="container_no_<?= $i ?>" type="text" readonly name="container_no[<?= $i ?>]" value="<?= $job_order[$i]['container_no'] ?>" class=" form-control">
                                                    </td>
                                                    <td>MBL NO</td>
                                                    <td>
                                                        <input id="mbl_no_<?= $i ?>" readonly name="mbl_no[<?= $i ?>]" class="form-control" type="text" required value="<?= $job_order[$i]['mbl_no'] ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>HBL NO</td>
                                                    <td>
                                                        <input readonly name="hbl_no[<?= $i ?>]" id="hbl_no_<?= $i ?>" class="form-control" type="text" required value="<?= $job_order[$i]['hbl_no'] ?>" />
                                                    </td>
                                                    <td>SHIPPING</td>
                                                    <td>
                                                        <input readonly name="shipping[<?= $i ?>]" id="shipping_<?= $i ?>" class="form-control" type="text" required value="<?= $job_order[$i]['shipper'] ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ETA</td>
                                                    <td>
                                                        <input readonly name="eta[<?= $i ?>]" id="eta_<?= $i ?>" class="form-control" type="text" required value="<?= $job_order[$i]['eta'] ?>" />
                                                    </td>
                                                    <td>CONSIGNE</td>
                                                    <td>
                                                        <input readonly name="consignee[<?= $i ?>]" id="consignee_<?= $i ?>" class="form-control" type="text" required value="<?= $job_order[$i]['consignee'] ?>" />
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
                                                    <table class="table" id="table_<?= $i ?>">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <td rowspan="2" width="10%">TASK</td>
                                                                <td colspan="2">Buying</td>
                                                                <td colspan="2">Selling</td>
                                                                <td colspan="2">Profit</td>
                                                            </tr>
                                                            <tr style="text-align: center;">
                                                                <td>IDR</td>
                                                                <td>USD</td>
                                                                <td>IDR</td>
                                                                <td>USD</td>
                                                                <td>IDR</td>
                                                                <td>USD</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($job_sheet as $row) {
                                                                if ($row['job_order_id'] == $job_order[$i]['id']) {
                                                                    $id_row = $i + $row['id'];
                                                            ?>
                                                                    <tr id='row_<?= $id_row ?>'>
                                                                        <td>
                                                                            <div class="autocomplete" style="width:100%;">
                                                                                <input required type="hidden" name="task_id[<?= $i ?>][]" value="<?= $row['task_id'] ?>">
                                                                                <input type="text" readonly value="<?= $row['task_name'] ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td><input type="text" id="buying_idr_<?= $i ?>'" name="buying_idr[<?= $i ?>][]" class=" form-control inp" value="<?= $row['buying_idr'] ?>"></td>
                                                                        <td><input type="text" id="buying_usd_<?= $i ?>" name="buying_usd[<?= $i ?>][]" class=" form-control inp" value="<?= $row['buying_usd'] ?>"></td>
                                                                        <td><input type="text" id="selling_idr_<?= $i ?>" name="selling_idr[<?= $i ?>][]" class=" form-control inp" value="<?= $row['selling_idr'] ?>"></td>
                                                                        <td><input type="text" id="selling_usd_<?= $i ?>" name="selling_usd[<?= $i ?>][]" class=" form-control inp" value="<?= $row['selling_usd'] ?>"></td>
                                                                        <td><input type="text" id="profit_idr_<?= $i ?>" name="profit_idr[<?= $i ?>][]" class=" form-control inp" value="<?= $row['profit_idr'] ?>"></td>
                                                                        <td><input type="text" id="profit_usd_<?= $i ?>" name="profit_usd[<?= $i ?>][]" class=" form-control inp" value="<?= $row['profit_usd'] ?>"></td>

                                                                    </tr>
                                                            <?php  }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <hr />
                                                    <table class="table" id="tableTotal">
                                                        <thead>
                                                            <tr id="" style="text-align: center;">
                                                                <td width="10%"><strong>TOTAL</strong></td>
                                                                <td><input type="text" id="total_buying_idr_<?= $i ?>" name="total_buying_idr[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_buying_idr'] ?>"></td>
                                                                <td><input type="text" id="total_buying_usd_<?= $i ?>" name="total_buying_usd[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_buying_usd'] ?>"></td>
                                                                <td><input type="text" id="total_selling_idr_<?= $i ?>" name="total_selling_idr[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_selling_idr'] ?>"></td>
                                                                <td><input type="text" id="total_selling_usd_<?= $i ?>" name="total_selling_usd[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_selling_usd'] ?>"></td>
                                                                <td><input type="text" id="total_profit_idr_<?= $i ?>" name="total_profit_idr[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_profit_idr'] ?>"></td>
                                                                <td><input type="text" id="total_profit_usd_<?= $i ?>" name="total_profit_usd[<?= $i ?>]" readonly class="form-control inp" value="<?= $job_order[$i]['total_profit_usd'] ?>"></td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
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
                        <a href="#" onclick="window.location.replace(' <?= site_url() . $temp_url  ?>');" class="btn btn-default pull-right"> Kembali</a>
                    </div>
                    <!--./col-md-12-->
                </div>
            </div>
        </form>
    </div>
</div>