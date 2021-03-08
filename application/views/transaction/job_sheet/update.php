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
if ($this->session->flashdata('response')) {
    $response = $this->session->flashdata('response');
    $this->session->unset_userdata('response');
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("Sukse Update Job Order", "", "success")
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
                            <label>JOB SHEETS NO</label>
                            <input name="job_sheets_id" readonly type="text" value="<?= $_GET['id'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Add Job Order</label><br>
                            <button type="button" onclick="add_job_order()" class="btn btn-warning"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <br />
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="tablist" role="tablist">
                                <?php
                                $i = 0;
                                foreach ($job_sheet as $row) {
                                    if (!@$tab_transisi[$row['order_number']]) {
                                        $tab_transisi[$row['order_number']] = $row; ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= $i == 0 ? 'active' : '' ?>" id="tab<?= $i ?>" data-toggle="tab" href="#content_tab<?= $i ?>" role="tab" aria-controls="tab<?= $i ?>" aria-selected="true">Sheet <?= $i + 1 ?></a>
                                        </li>
                                <?php
                                        $i = $i + 1;
                                    }
                                }
                                ?>

                            </ul>

                            <div class="tab-content" id="tabcontentlist">
                                <?php
                                $n = 0;
                                foreach ($job_sheet as $row) {
                                    if (!@$transisi[$row['order_number']]) {
                                        $transisi[$row['order_number']] = $row;
                                ?>
                                        <div class="tab-pane fade show <?= $n == 0 ? 'active' : '' ?>" id="content_tab<?= $n ?>" role="tabpanel" aria-labelledby="content_tab<?= $n ?>">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>ORDER NO</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <div id="order_number">
                                                                    <input id="inp_order_number_<?= $n ?>" name="order_number[<?= $n ?>]" required onclick="get_order_number('inp_order_number_<?= $n ?>',<?= $n ?>)" type="text" autocomplete="off" value="<?= $row['order_number'] ?>">
                                                                    <input id="job_order_id_<?= $n ?>" name="job_order_id[<?= $n ?>]" required type="hidden" value="<?= $row['job_order_id'] ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>EX VESSEL</td>
                                                        <td>
                                                            <input readonly name="ex_vessel[<?= $n ?>]" id="ex_vessel_<?= $n ?>" type="text" class="form-control" required value="<?= $row['vessel'] ?>" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CONTAINER NO</td>
                                                        <td>
                                                            <input id="container_no_<?= $n ?>" type="text" readonly name="container_no[<?= $n ?>]" value="<?= $row['container_no'] ?>" class=" form-control">
                                                        </td>
                                                        <td>MBL NO</td>
                                                        <td>
                                                            <input id="mbl_no_<?= $n ?>" readonly name="mbl_no[<?= $n ?>]" class="form-control" type="text" required value="<?= $row['mbl_no'] ?>" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>HBL NO</td>
                                                        <td>
                                                            <input readonly name="hbl_no[<?= $n ?>]" id="hbl_no_<?= $n ?>" class="form-control" type="text" required value="<?= $row['hbl_no'] ?>" />
                                                        </td>
                                                        <td>SHIPPING</td>
                                                        <td>
                                                            <input readonly name="shipping[<?= $n ?>]" id="shipping_<?= $n ?>" class="form-control" type="text" required value="<?= $row['shipper'] ?>" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ETA</td>
                                                        <td>
                                                            <input readonly name="eta[<?= $n ?>]" id="eta_<?= $n ?>" class="form-control" type="text" required value="<?= $row['eta'] ?>" />
                                                        </td>
                                                        <td>CONSIGNE</td>
                                                        <td>
                                                            <input readonly name="consignee[<?= $n ?>]" id="consignee_<?= $n ?>" class="form-control" type="text" required value="<?= $row['consignee'] ?>" />
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
                                                        <table class="table" id="table_<?= $n ?>">
                                                            <thead>
                                                                <tr style="text-align: center;">
                                                                    <td rowspan="2" width="10%">TASK</td>
                                                                    <td colspan="2">Buying</td>
                                                                    <td colspan="2">Selling</td>
                                                                    <td colspan="2">Profit</td>
                                                                    <td rowspan="2">Action</td>
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
                                                                foreach ($job_sheet as $row_details) {
                                                                    if ($row['job_order_id'] == $row_details['job_order_id']) {
                                                                        $id_row = $row_details['detail_job_sheets_id'];
                                                                ?>
                                                                        <input id="detail_job_sheets_id_<?= $n ?>" name="detail_job_sheets_id[<?= $n ?>][]" required type="hidden" value="<?= $row_details['detail_job_sheets_id'] ?>">
                                                                        <tr id='row_<?= $id_row ?>'>
                                                                            <td>
                                                                                <div class="autocomplete" style="width:100%;">
                                                                                    <input required type="hidden" name="task_id[<?= $n ?>][]" value="<?= $row_details['task_id'] ?>">
                                                                                    <input type="text" readonly value="<?= $row_details['task_name'] ?>">
                                                                                </div>
                                                                            </td>
                                                                            <td><input type="text" id="buying_idr_<?= $n ?>'" name="buying_idr[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['buying_idr'] ?>"></td>
                                                                            <td><input type="text" id="buying_usd_<?= $n ?>" name="buying_usd[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['buying_usd'] ?>"></td>
                                                                            <td><input type="text" id="selling_idr_<?= $n ?>" name="selling_idr[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['selling_idr'] ?>"></td>
                                                                            <td><input type="text" id="selling_usd_<?= $n ?>" name="selling_usd[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['selling_usd'] ?>"></td>
                                                                            <td><input type="text" id="profit_idr_<?= $n ?>" name="profit_idr[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['profit_idr'] ?>"></td>
                                                                            <td><input type="text" id="profit_usd_<?= $n ?>" name="profit_usd[<?= $n ?>][]" class=" form-control inp" value="<?= $row_details['profit_usd'] ?>"></td>
                                                                            <td style="text-align:center;">
                                                                                <a type='button' onclick='delete_row("row_<?= $id_row ?>")' class='closebtn btn btn-warning'><i class='fas fa-times'></i></a>
                                                                            </td>
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
                                                                    <td><input type="text" id="total_buying_idr_<?= $n ?>" name="total_buying_idr[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_buying_idr'] ?>"></td>
                                                                    <td><input type="text" id="total_buying_usd_<?= $n ?>" name="total_buying_usd[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_buying_usd'] ?>"></td>
                                                                    <td><input type="text" id="total_selling_idr_<?= $n ?>" name="total_selling_idr[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_selling_idr'] ?>"></td>
                                                                    <td><input type="text" id="total_selling_usd_<?= $n ?>" name="total_selling_usd[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_selling_usd'] ?>"></td>
                                                                    <td><input type="text" id="total_profit_idr_<?= $n ?>" name="total_profit_idr[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_profit_idr'] ?>"></td>
                                                                    <td><input type="text" id="total_profit_usd_<?= $n ?>" name="total_profit_usd[<?= $n ?>]" readonly class="form-control inp" value="<?= @$row['total_profit_usd'] ?>"></td>
                                                                    <td><button type="button" onclick="make_total(<?= $n ?>)" class="btn btn-info"><i class="fa fa-calculator"> </button></td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $n = $n + 1;
                                    }
                                }
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
                        <button type="submit" name="submit" id="contact_submit" class="btn btn-info pull-right"> Simpan</button>
                        <a href="#" onclick="window.location.replace(' <?= site_url() . $temp_url  ?>');" class="btn btn-default pull-right"> Kembali</a>

                    </div>
                    <!--./col-md-12-->
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url() ?>assets/ajax/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    var arr_list_jobsheet = [];
    var arr = <?= json_encode($job_sheet) ?>;
    for (const item of arr) {
        arr_list_jobsheet.push(item.order_number)
    }

    function add_job_order() {
        var no_tab = $("#tablist li").length
        no_tab = no_tab + 1;
        var li = ` <li class="nav-item" id="li_tab` + no_tab + `">
                        <a class="nav-link" id="tab` + no_tab + `" data-toggle="tab" href="#content_tab` + no_tab + `" role="tab" aria-controls="#content_tab` + no_tab + `" aria-selected="false">Sheet ` + no_tab + ` </a>
                    </li>`;
        var content = ` 
                        <a onclick="close_sheet(` + no_tab + `)" class="btn btn-danger float-right" style="color:white;">close sheet <i class="fa fa-times"></i></a>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>ORDER NO</td>
                                    <td>
                                        <div class="input-group">
                                            <div id="order_number">
                                                <input id="inp_order_number_` + no_tab + `" name="order_number[` + no_tab + `]" required onclick="get_order_number('inp_order_number_` + no_tab + `',` + no_tab + `)" type="text" autocomplete="off" placeholder="Seach Order No">
                                                <input id="job_order_id_` + no_tab + `" name="job_order_id[` + no_tab + `]" required type="hidden">
                                            </div>
                                        </div>
                                    </td>
                                    <td>EX VESSEL</td>
                                    <td>
                                        <input readonly name="ex_vessel[` + no_tab + `]" id="ex_vessel_` + no_tab + `" type="text" class="form-control" required value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>CONTAINER NO</td>
                                    <td>
                                        <input id="container_no_` + no_tab + `" type="text" readonly name="container_no[` + no_tab + `]" value="" class=" form-control">
                                    </td>
                                    <td>MBL NO</td>
                                    <td>
                                        <input id="mbl_no_` + no_tab + `" readonly name="mbl_no[` + no_tab + `]" class="form-control" type="text" required value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>HBL NO</td>
                                    <td>
                                        <input readonly name="hbl_no[` + no_tab + `]" id="hbl_no_` + no_tab + `" class="form-control" type="text" required value="" />
                                    </td>
                                    <td>SHIPPING</td>
                                    <td>
                                        <input readonly name="shipping[` + no_tab + `]" id="shipping_` + no_tab + `" class="form-control" type="text" required value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>ETA</td>
                                    <td>
                                        <input readonly name="eta[` + no_tab + `]" id="eta_` + no_tab + `" class="form-control" type="text" required value="" />
                                    </td>
                                    <td>CONSIGNE</td>
                                    <td>
                                        <input readonly name="consignee[` + no_tab + `]" id="consignee_` + no_tab + `" class="form-control" type="text" required value="" />
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
                                <table class="table" id="table_` + no_tab + `">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <td rowspan="2" width="10%">TASK</td>
                                            <td colspan="2">Buying</td>
                                            <td colspan="2">Selling</td>
                                            <td colspan="2">Profit</td>
                                            <td rowspan="2">Action</td>
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
                                </table>
                                <hr />
                                <table class="table" id="tableTotal">
                                    <thead>
                                        <tr id="" style="text-align: center;">
                                            <td width="10%"><strong>TOTAL</strong></td>
                                            <td><input type="text" id="total_buying_idr_` + no_tab + `" name="total_buying_idr[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_buying_usd_` + no_tab + `" name="total_buying_usd[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_selling_idr_` + no_tab + `" name="total_selling_idr[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_selling_usd_` + no_tab + `" name="total_selling_usd[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_profit_idr_` + no_tab + `" name="total_profit_idr[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_profit_usd_` + no_tab + `" name="total_profit_usd[` + no_tab + `]" readonly class="form-control inp" value="0"></td>
                                            <td><button type="button" onclick="make_total(` + no_tab + `)" class="btn btn-info"><i class="fa fa-calculator"> </button></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>`;
        var tab = ` <div class="tab-pane fade" id="content_tab` + no_tab + `" role="tabpanel" aria-labelledby="content_tab` + no_tab + `">
                            ` + content + `
                        </div>`;

        $("#tablist").append(li);
        $("#tabcontentlist").append(tab);
        // console.log(no_tab);
    }

    function make_total(n) {
        var buying_idr = document.getElementsByName('buying_idr[' + n + '][]');
        var buying_usd = document.getElementsByName('buying_usd[' + n + '][]');
        var selling_idr = document.getElementsByName('selling_idr[' + n + '][]');
        var selling_usd = document.getElementsByName('selling_usd[' + n + '][]');
        var profit_idr = document.getElementsByName('profit_idr[' + n + '][]');
        var profit_usd = document.getElementsByName('profit_usd[' + n + '][]');

        var total_buying_idr = 0
        var total_buying_usd = 0
        var total_selling_idr = 0
        var total_selling_usd = 0
        var total_profit_idr = 0
        var total_profit_usd = 0

        for (var i = 0; i < buying_idr.length; i++) {
            var inp_buying_idr = buying_idr[i].value ? buying_idr[i].value : 0;
            var inp_buying_usd = buying_usd[i].value ? buying_usd[i].value : 0;
            var inp_selling_idr = selling_idr[i].value ? selling_idr[i].value : 0;
            var inp_selling_usd = selling_usd[i].value ? selling_usd[i].value : 0;
            var inp_profit_idr = profit_idr[i].value ? profit_idr[i].value : 0;
            var inp_profit_usd = profit_usd[i].value ? profit_usd[i].value : 0;


            total_buying_idr += +parseFloat(inp_buying_idr).toFixed(3);
            total_buying_usd += +parseFloat(inp_buying_usd).toFixed(3);
            total_selling_idr += +parseFloat(inp_selling_idr).toFixed(3);
            total_selling_usd += +parseFloat(inp_selling_usd).toFixed(3);
            total_profit_idr += +parseFloat(inp_profit_idr).toFixed(3);
            total_profit_usd += +parseFloat(inp_profit_usd).toFixed(3);
        }
        $("#total_buying_idr_" + n).val(total_buying_idr);
        $("#total_buying_usd_" + n).val(total_buying_usd);
        $("#total_selling_idr_" + n).val(total_selling_idr);
        $("#total_selling_usd_" + n).val(total_selling_usd);
        $("#total_profit_idr_" + n).val(total_profit_idr);
        $("#total_profit_usd_" + n).val(total_profit_usd);

    }

    function delete_row(_id_row) {
        $("#" + _id_row).html("");
    }

    function close_sheet(_id_row) {
        delete arr_list_jobsheet[_id_row];
        var li_tab = $("#li_tab" + _id_row).remove();
        var content_tab = $("#content_tab" + _id_row).remove();
    }
</script>


<script>
    function get_order_number(inp_id, n) {
        var inp_id = document.getElementById(inp_id)
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        var list_task = [];
        /*execute a function when someone writes in the text field:*/
        inp_id.addEventListener("input", function(e) {
            // console.log('input')
            var a, b, i, val = this.value;

            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?= site_url() ?>transaction/Ajax_data/get_available_order_number", // Isi dengan url/path file php yang dituju
                data: {
                    text: val
                },
                success: function(isi) {
                    if (isi)
                        isi = JSON.parse(isi);
                    if (isi.length == 0) {
                        b = document.createElement("DIV");
                        b.innerHTML = "...data not found";
                        a.appendChild(b);
                    } else {
                        for (i = 0; i < isi.length; i++) {
                            if (isi[i].order_number.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                var tampilkan = true;
                                for (const jb_sht of arr_list_jobsheet) {
                                    if (jb_sht == isi[i].order_number) {
                                        tampilkan = false
                                    }
                                }
                                if (tampilkan == true) {
                                    b = document.createElement("DIV");
                                    /*make the matching letters bold:*/
                                    b.setAttribute('all-data', JSON.stringify(isi[i]));
                                    b.innerHTML = "<strong>" + isi[i].order_number.substr(0, val.length) + "</strong>";
                                    b.innerHTML += isi[i].order_number.substr(val.length);
                                    /*insert a input field that will hold the current array item's value:*/
                                    b.innerHTML += "<input type='hidden'>";
                                    /*execute a function when someone clicks on the item value (DIV element):*/
                                    b.addEventListener("click", function(e) {
                                        var selected_val = JSON.parse(this.getAttribute('all-data'));
                                        var order_number = selected_val.order_number;
                                        $('#inp_order_number_' + n).val(selected_val.order_number);
                                        $('#job_order_id_' + n).val(selected_val.job_order_id);
                                        $('#ex_vessel_' + n).val(selected_val.vessel);
                                        $('#container_no_' + n).val(selected_val.container_no);
                                        $('#mbl_no_' + n).val(selected_val.mbl_no);
                                        $('#hbl_no_' + n).val(selected_val.hbl_no);
                                        $('#shipping_' + n).val(selected_val.shipping_name);
                                        $('#eta_' + n).val(selected_val.eta);
                                        $('#consignee_' + n).val(selected_val.consignee);
                                        $('#consignee_' + n).val(selected_val.consignee);
                                        arr_list_jobsheet[n] = selected_val.order_number;
                                        var table = document.getElementById("table_" + n);
                                        var table_len = (table.rows.length);
                                        var id = parseInt(table_len);

                                        $.ajax({
                                            type: "POST", // Method pengiriman data bisa dengan GET atau POST
                                            url: "<?= site_url() ?>transaction/Ajax_data/get_all_task_by_order_number", // Isi dengan url/path file php yang dituju
                                            data: {
                                                order_number: order_number
                                            },
                                            success: function(res) {
                                                res = JSON.parse(res);
                                                // console.log(res)
                                                for (i = 0; i < res.length; i++) {
                                                    var _id_row = n + `_` + id + i
                                                    var _row = `
                                                <tr id='row_` + _id_row + `'>
                                                    <td>
                                                        <div class="autocomplete" style="width:100%;">
                                                            <input id="inp` + id + i + `" required type="hidden" name="task_id[` + n + `][]" value="` + res[i].task_id + `">
                                                            <input type="text" readonly value="` + res[i].task_name + `">
                                                        </div>    
                                                    </td> 
                                                    <td><input type="text" id="buying_idr_` + n + `" name="buying_idr[` + n + `][]" class=" form-control inp" value="` + res[i].buying_idr + `"></td>
                                                    <td><input type="text" id="buying_usd_` + n + `" name="buying_usd[` + n + `][]" class=" form-control inp" value="` + res[i].buying_usd + `"></td>
                                                    <td><input type="text" id="selling_idr_` + n + `" name="selling_idr[` + n + `][]" class=" form-control inp" value="` + res[i].selling_idr + `"></td>
                                                    <td><input type="text" id="selling_usd_` + n + `" name="selling_usd[` + n + `][]" class=" form-control inp" value="` + res[i].selling_usd + `"></td>
                                                    <td><input type="text" id="profit_idr_` + n + `" name="profit_idr[` + n + `][]" class=" form-control inp" value="` + res[i].profit_idr + `"></td>
                                                    <td><input type="text" id="profit_usd_` + n + `" name="profit_usd[` + n + `][]" class=" form-control inp" value="` + res[i].profit_usd + `"></td>
                                                    <td style="text-align:center;">
                                                        <a type='button' onclick='delete_row("row_` + _id_row + `")' class='closebtn btn btn-warning'><i class='fas fa-times'></i></a>
                                                    </td>
                                                </tr>`;
                                                    var row = table.insertRow(table_len).outerHTML = _row;
                                                }
                                            }
                                        });
                                        closeAllLists();
                                    });
                                    a.appendChild(b);
                                }
                            }
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    return false;
                    // alert(thrownError); // Munculkan alert error
                }
            });
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/

        });
        /*execute a function presses a key on the keyboard:*/
        inp_id.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            // console.log(val = this.value)
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp_id) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }
</script>