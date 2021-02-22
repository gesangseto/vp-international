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
                    <h1 class="h3 mb-0 text-gray-800">Create <?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
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
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>JOB SHEETS NO</td>
                                        <td>
                                            <input name="job_sheets_id" readonly type="text" value="<?= $form['job_sheets_id'] ?>">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>ORDER NO</td>
                                        <td>
                                            <div class="input-group">
                                                <div id="order_number">
                                                    <input id="inp_order_number" name="order_number" required onclick="get_order_number('inp_order_number')" type="text" autocomplete="off" placeholder="Seach Order No">
                                                    <input id="job_order_id" name="job_order_id" required type="hidden">
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
                                            <input id="container_no" type="text" readonly name="container_no" value="<?= @$form['container_no'] ?>" class=" form-control">
                                        </td>
                                        <td>MBL NO</td>
                                        <td>
                                            <input id="mbl_no" readonly name="mbl_no" class="form-control" type="text" required value="<?= @$form['mbl_no'] ?>" />
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
                                <table class="table" id="tableID">
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
                                            <td><input type="text" id="total_buying_idr" name="total_buying_idr" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_buying_usd" name="total_buying_usd" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_selling_idr" name="total_selling_idr" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_selling_usd" name="total_selling_usd" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_profit_idr" name="total_profit_idr" readonly class="form-control inp" value="0"></td>
                                            <td><input type="text" id="total_profit_usd" name="total_profit_usd" readonly class="form-control inp" value="0"></td>
                                            <td><button type="button" onclick="make_total()" class="btn btn-info"><i class="fa fa-calculator"> </button></td>
                                        </tr>
                                    </thead>
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
    function make_total() {
        var buying_idr = document.getElementsByName('buying_idr[]');
        var buying_usd = document.getElementsByName('buying_usd[]');
        var selling_idr = document.getElementsByName('selling_idr[]');
        var selling_usd = document.getElementsByName('selling_usd[]');
        var profit_idr = document.getElementsByName('profit_idr[]');
        var profit_usd = document.getElementsByName('profit_usd[]');

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
        $("#total_buying_idr").val(total_buying_idr);
        $("#total_buying_usd").val(total_buying_usd);
        $("#total_selling_idr").val(total_selling_idr);
        $("#total_selling_usd").val(total_selling_usd);
        $("#total_profit_idr").val(total_profit_idr);
        $("#total_profit_usd").val(total_profit_usd);

    }

    function delete_row(id) {
        var table = document.getElementById("tableID");
        var rowCount = table.rows.length;
        $("#row" + id).html("");
    }
</script>


<script>
    function get_order_number(inp_id) {
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
                                    $('#inp_order_number').val(selected_val.order_number);
                                    $('#job_order_id').val(selected_val.job_order_id);
                                    $('#ex_vessel').val(selected_val.vessel);
                                    $('#container_no').val(selected_val.container_no);
                                    $('#mbl_no').val(selected_val.mbl_no);
                                    $('#hbl_no').val(selected_val.hbl_no);
                                    $('#shipping').val(selected_val.shipping_name);
                                    $('#eta').val(selected_val.eta);
                                    $('#consignee').val(selected_val.consignee);

                                    var table = document.getElementById("tableID");
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
                                            console.log(res)
                                            for (i = 0; i < res.length; i++) {
                                                var _row = `
                                                <tr id='row` + id + i + `'>
                                                    <td>
                                                        <div class="autocomplete" style="width:100%;">
                                                            <input id="inp` + id + i + `" required type="hidden" name="task_id[]" value="` + res[i].task_id + `">
                                                            <input type="text" readonly value="` + res[i].task_name + `">
                                                        </div>    
                                                    </td> 
                                                    <td><input type="text" id="buying_idr" name="buying_idr[]" class=" form-control inp" value="` + res[i].buying_idr + `"></td>
                                                    <td><input type="text" id="buying_usd" name="buying_usd[]" class=" form-control inp" value="` + res[i].buying_usd + `"></td>
                                                    <td><input type="text" id="selling_idr" name="selling_idr[]" class=" form-control inp" value="` + res[i].selling_idr + `"></td>
                                                    <td><input type="text" id="selling_usd" name="selling_usd[]" class=" form-control inp" value="` + res[i].selling_usd + `"></td>
                                                    <td><input type="text" id="profit_idr" name="profit_idr[]" class=" form-control inp" value="` + res[i].profit_idr + `"></td>
                                                    <td><input type="text" id="profit_usd" name="profit_usd[]" class=" form-control inp" value="` + res[i].profit_usd + `"></td>
                                                    <td style="text-align:center;">
                                                        <a type='button' onclick='delete_row(` + id + i + `)' class='closebtn btn btn-warning'><i class='fas fa-times'></i></a>
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