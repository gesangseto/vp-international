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
                                    <input id="customer_id" name="customer_id" readonly type="hidden" value="<?= @$customer['customer_id'] ?>">
                                    <input id="customer_name" name="customer_name" class="form-control" required onclick="get_agent()" value="<?= @$customer['customer_name'] ?>" type="text" autocomplete="off" placeholder="Seach Agent">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <?php
                                    $address = $customer['customer_address'] . ', ' . $customer['customer_region'] . ', ' . $customer['customer_district'] . ', ' . $customer['customer_city'] . ', ' . $customer['customer_country'] . '. ' . $customer['customer_postal_code'];

                                    ?>
                                    <textarea class="form-control" readonly id="customer_address"><?= @$address ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label>PHONE</label>
                                    <input id="customer_phone" readonly value="<?= @$customer['customer_phone'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>INVOICE NUMBER</label>
                                    <input name="invoice_number" class="form-control" readonly type="text" value="<?= @$bill_note[0]['invoice_number'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>INVOICE DATE</label>
                                    <input name="invoice_date" class="form-control" readonly type="text" value="<?= @$bill_note[0]['invoice_date'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label>SHIPMENT TYPE</label>
                                    <input name="shipment_type" class="form-control" type="text" value="<?= @$bill_note[0]['shipment_type'] ?>">
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
                                                    <input id="inp_order_number" name="order_number" required onclick="get_order_number()" value="<?= @$bill_note[0]['order_number'] ?>" type="text" class="form-control" autocomplete="off" placeholder="Seach Order No">
                                                    <input id="job_order_id" name="job_order_id" value="<?= @$bill_note[0]['job_order_id'] ?>" required type="hidden">
                                                </div>
                                            </div>
                                        </td>
                                        <td>EX VESSEL</td>
                                        <td>
                                            <input readonly id="ex_vessel" type="text" class="form-control" required value="<?= $bill_note[0]['vessel'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONTAINER NO</td>
                                        <td>
                                            <input id="container_no" type="text" readonly value="<?= @$bill_note[0]['container_no'] ?>" class=" form-control">
                                        </td>
                                        <td>MBL NO</td>
                                        <td>
                                            <input id="mbl_no" readonly class="form-control" type="text" required value="<?= @$bill_note[0]['mbl_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HBL NO</td>
                                        <td>
                                            <input readonly id="hbl_no" class="form-control" type="text" required value="<?= @$bill_note[0]['hbl_no'] ?>" />
                                        </td>
                                        <td>SHIPPING</td>
                                        <td>
                                            <input readonly id="shipping" class="form-control" type="text" required value="<?= @$bill_note[0]['shipper'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ETA</td>
                                        <td>
                                            <input readonly id="eta" class="form-control" type="text" required value="<?= @$bill_note[0]['eta'] ?>" />
                                        </td>
                                        <td>CONSIGNE</td>
                                        <td>
                                            <input readonly id="consignee" class="form-control" type="text" required value="<?= @$bill_note[0]['consignee'] ?>" />
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
                                            foreach ($bill_note as $row) {
                                                $id_row = $row['bill_note_id'];

                                                echo  '<input name="bill_note_id[]" class="form-control" readonly type="hidden" value="' . @$row['bill_note_id'] . '">';
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
                                            }
                                            ?>
                                        </table>
                                        <hr />
                                        <table class="table" id="tableTotal">
                                            <thead>
                                                <tr id="" style="text-align: center;">
                                                    <td width="50%"><strong>TOTAL</strong></td>
                                                    <td> <input type="text" id="total_amount" name="total_amount" readonly class="form-control" value="0"></td>
                                                    <td><input type="text" id="total_vat" name="total_vat" readonly class="form-control" value="0"></td>
                                                    <td><input type="text" id="grand_total" name="grand_total" readonly class="form-control" value="<?= @$bill_note[0]['grand_total'] ?>"></td>
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

<script src="<?= base_url() ?>assets/ajax/3.4.1/jquery.min.js"></script>


<script type="text/javascript">
    var arr_list_jobsheet = [];

    function make_total(n) {
        var amount = document.getElementsByName('amount[]');
        var vat = document.getElementsByName('vat[]');
        var total = document.getElementsByName('total[]');

        var total_amount = 0
        var total_vat = 0
        var grand_total = 0

        for (var i = 0; i < amount.length; i++) {
            var inp_total_amount = amount[i].value ? amount[i].value : 0;
            var inp_total_vat = vat[i].value ? vat[i].value : 0;
            var inp_grand_total = total[i].value ? total[i].value : 0;


            total_amount += +parseFloat(inp_total_amount).toFixed(3);
            total_vat += +parseFloat(inp_total_vat).toFixed(3);
            grand_total += +parseFloat(inp_grand_total).toFixed(3);
        }
        $("#total_amount").val(total_amount);
        $("#total_vat").val(total_vat);
        $("#grand_total").val(grand_total);

    }

    function sum_total(id_row) {
        var quantity = $('#quantity' + id_row).val();
        var currency = $('#currency' + id_row).val();
        var rate = $('#rate' + id_row).val();



        var amount = quantity * rate;
        var vat = amount / 100
        var total = amount + vat;
        $('#amount' + id_row).val(amount);
        $('#vat' + id_row).val(vat);
        $('#total' + id_row).val(total);

    }

    function delete_row(_id_row) {
        console.log(_id_row);
        $("#" + _id_row).html("");
    }
</script>


<script>
    function get_agent() {
        var inp_id = document.getElementById('customer_name')
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
                url: "<?= site_url() ?>transaction/Ajax_data/get_agent", // Isi dengan url/path file php yang dituju
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
                            if (isi[i].customer_name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                                b = document.createElement("DIV");
                                /*make the matching letters bold:*/
                                b.setAttribute('all-data', JSON.stringify(isi[i]));
                                b.innerHTML = "<strong>" + isi[i].customer_name.substr(0, val.length) + "</strong>";
                                b.innerHTML += isi[i].customer_name.substr(val.length);
                                /*insert a input field that will hold the current array item's value:*/
                                b.innerHTML += "<input type='hidden'>";
                                /*execute a function when someone clicks on the item value (DIV element):*/
                                b.addEventListener("click", function(e) {
                                    var selected_val = JSON.parse(this.getAttribute('all-data'));
                                    var address = selected_val.customer_address + ', ' + selected_val.customer_region + ', ' + selected_val.customer_district + ', ' + selected_val.customer_city + ', ' + selected_val.customer_country + '. ' + selected_val.customer_postal_code
                                    $('#customer_id').val(selected_val.customer_id);
                                    $('#customer_name').val(selected_val.customer_name);
                                    $('#customer_address').val(address);
                                    $('#customer_phone').val(selected_val.customer_phone);

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


<script>
    function get_order_number() {
        var inp_id = document.getElementById('inp_order_number')
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
                url: "<?= site_url() ?>transaction/Ajax_data/get_job_order_verified", // Isi dengan url/path file php yang dituju
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
                                    $('#job_order_id').val(selected_val.id);
                                    $('#ex_vessel').val(selected_val.vessel);
                                    $('#container_no').val(selected_val.container_no);
                                    $('#mbl_no').val(selected_val.mbl_no);
                                    $('#hbl_no').val(selected_val.hbl_no);
                                    $('#shipping').val(selected_val.shipping_name);
                                    $('#eta').val(selected_val.eta);
                                    $('#consignee').val(selected_val.consignee);
                                    var table = document.getElementById("table_description");
                                    var table_len = (table.rows.length);
                                    var id = parseInt(table_len);


                                    $.ajax({
                                        type: "POST", // Method pengiriman data bisa dengan GET atau POST
                                        url: "<?= site_url() ?>transaction/Ajax_data/get_task_by_order_number", // Isi dengan url/path file php yang dituju
                                        data: {
                                            order_number: order_number
                                        },
                                        success: function(res) {

                                            res = JSON.parse(res);
                                            for (i = 0; i < res.length; i++) {
                                                var _id_row = id + i
                                                var _row = `
                                                <tr id='row_` + _id_row + `'>
                                                    <td>
                                                        <div class="autocomplete" style="width:100%;">
                                                            <input id="inp` + id + i + `" required type="hidden" name="task_id[]" value="` + res[i].task_id + `">
                                                            <input type="text"class="form-control" readonly value="` + res[i].task_name + `">
                                                        </div>    
                                                    </td> 
                                                    <td><input id="quantity` + _id_row + `"  onkeyup="sum_total('` + _id_row + `')"  type="text" class="form-control" required name="quantity[]" class=" form-control" value=""></td>
                                                    <td><input id="currency` + _id_row + `" type="text" class="form-control" readonly name="currency[]" class=" form-control" value="IDR"></td>
                                                    <td><input id="rate` + _id_row + `" type="text" class="form-control" readonly name="rate[]" class=" form-control" value="` + res[i].buying_idr + `"></td>
                                                    <td><input id="amount` + _id_row + `" type="text" class="form-control" readonly name="amount[]" class=" form-control" value=""></td>
                                                    <td><input id="vat` + _id_row + `" type="text"class="form-control" readonly name="vat[]" class=" form-control" value=""></td>
                                                    <td><input id="total` + _id_row + `" type="text" class="form-control" readonly name="total[]" class=" form-control" value=""></td>
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