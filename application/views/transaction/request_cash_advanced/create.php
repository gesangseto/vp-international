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
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ADVANCE FROM</td>
                                        <td>
                                            <input name="advance_from" type="text" class="form-control" required value="<?= @$form['advance_from'] ?>" />
                                        </td>
                                        <td>RECEIPT NO</td>
                                        <td>
                                            <input name="receipt_no" type="text" class="form-control" required value="<?= @$form['receipt_no'] ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ORDER NO</td>
                                        <td>
                                            <div class="input-group">
                                                <div id="order_number">
                                                    <input id="inp_order_number" name="order_number" required onclick="get_order_number('inp_order_number')" type="text" autocomplete="off" placeholder="Seach Order No">
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
                                        <td rowspan="2"><button type="button" for="customControlInline" onclick="add_more()" class="btn btn-success"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <td>IDR</td>
                                        <td>USD</td>
                                    </tr>
                                    <tr id="row0">
                                        <td width="20%">
                                            <div class="autocomplete" style="width:100%;">
                                                <input id="inp0" required type="text" class="back-of-everything" name="task_id[]">
                                                <input id="view0" required onclick="get_task('view0','inp0')" type="text" name="task_name[]" autocomplete="off" placeholder="Task" class="form-control inp">
                                            </div>
                                        </td>
                                        <td width="15%">
                                            <input type="text" id="ca_idr_amount" name="ca_idr[]" class=" form-control inp" value="0">
                                        </td>
                                        <td width="10%">
                                            <input type="text" id="ca_usd_amount" name="ca_usd[]" class=" form-control inp" value="0">
                                        </td>
                                        <td width="5%"></td>
                                    </tr>
                                </table>
                                <hr />
                                <table class="tableTotal" id="tableTotal" border="1">
                                    <tr id="" style="text-align: center;">
                                        <td width="20%"><strong>TOTAL</strong></td>
                                        <td width="15%"><input type="text" id="total_ca_idr" name="total_ca_idr" readonly class="form-control inp" value="0"></td>
                                        <td width="10%"><input type="text" id="total_ca_usd" name="total_ca_usd" readonly class="form-control inp" value="0"></td>
                                        <td width="5%"><button type="button" onclick="add_allowance()" class="btn btn-info"><i class="fa fa-calculator"> </button></td>
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

    function add_more() {
        var table = document.getElementById("tableID");
        var table_len = (table.rows.length);
        var id = parseInt(table_len);
        var _row = `

        <tr id='row` + id + `'>
            <td>
                <div class="autocomplete" style="width:100%;">
                    <input type='text' id="inp` + id + `" required type="text" class="back-of-everything" name="task_id[]">
                    <input id="view` + id + `" required onclick="get_task('view` + id + `','inp` + id + `')" type="text" name="task_name[]" autocomplete="off" placeholder="Task">
                </div>    
            </td> 
            <td width="15%"><input type="text" id="ca_idr_amount" name="ca_idr[]" class=" form-control inp" value="0"></td>
            <td width="10%"><input type="text" id="ca_usd_amount" name="ca_usd[]" class=" form-control inp" value="0"></td>
            <td style="text-align:center;">
                <a type='button' onclick='delete_row(` + id + `)' class='closebtn btn btn-warning'><i class='fas fa-times'></i></a>
            </td>
        </tr>`;
        var row = table.insertRow(table_len).outerHTML = _row;
    }

    function delete_row(id) {
        var table = document.getElementById("tableID");
        var rowCount = table.rows.length;
        $("#row" + id).html("");
    }
</script>



<!--

MULAI AUTO COMPLETE

-->
<script>
    function get_task(view, inp) {
        var view = document.getElementById(view)
        var inp = document.getElementById(inp)
        console.log(view);
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        var list_task = [];
        /*execute a function when someone writes in the text field:*/
        view.addEventListener("input", function(e) {
            // console.log('input')
            var a, b, i, val = this.value;

            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?= site_url() ?>transaction/Ajax_data/get_task", // Isi dengan url/path file php yang dituju
                data: {
                    text: val
                },
                success: function(isi) {
                    isi = JSON.parse(isi);
                    var sudah_terpakai = document.getElementsByName('task_id[]');
                    for (i = 0; i < isi.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (isi[i].task_name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                            // jika sudah dipilih akan dihilangkan dari list
                            for (const row of sudah_terpakai) {
                                if (row.value == isi[i].id) {
                                    return false
                                }
                            }
                            /*create a DIV element for each matching element:*/
                            b = document.createElement("DIV");
                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + isi[i].task_name.substr(0, val.length) + "</strong>";
                            b.innerHTML += isi[i].task_name.substr(val.length);
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<input type='hidden' name='task_js[]' value='" + isi[i].id + "' placeholder='" + isi[i].task_name + "'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                                /*insert the value for the autocomplete text field:*/
                                view.value = this.getElementsByTagName("input")[0].placeholder;
                                inp.value = this.getElementsByTagName("input")[0].value;
                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            a.appendChild(b);
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
        view.addEventListener("keydown", function(e) {
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
                if (elmnt != x[i] && elmnt != view) {
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
                    for (i = 0; i < isi.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (isi[i].order_number.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                            // console.log(isi[i].vessel)
                            // ex_vessel.value = isi[i].vessel
                            /*create a DIV element for each matching element:*/
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
                                /*insert the value for the autocomplete text field:*/
                                // inp_id.value = this.getElementsByTagName("input")[0].value;
                                $('#inp_order_number').val(selected_val.order_number);
                                $('#ex_vessel').val(selected_val.vessel);
                                $('#container_no').val(selected_val.container_no);
                                $('#mbl_no').val(selected_val.mbl_no);
                                $('#hbl_no').val(selected_val.hbl_no);
                                $('#shipping').val(selected_val.shipping_name);
                                $('#eta').val(selected_val.eta);
                                $('#consignee').val(selected_val.consignee);
                                closeAllLists();
                            });
                            a.appendChild(b);
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