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

    .borderless td,
    .borderless th {
        border: none;
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
                    <h1 class="h3 mb-0 text-gray-800">Read <?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
                </div>
                <div class="col-md-2">

                    <input class="btn btn-info pull-right" type="button" onclick="PrintElem('printableArea')" value="Cetak" />
                </div>
            </div>
        </div>

        <div class="card-body" id="printableArea">
            <div class="box box-primary">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%;border: none;">
                            <tr>
                                <td>
                                    <h3>TO</h3>
                                </td>
                                <td>
                                    <h3><?= @$agent['agent_name'] ?></h3>
                                </td>
                                <td colspan="3" style="text-align: center;">
                                    <h2>INVOICE</h2>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%"></td>
                                <td width="40%">
                                    <h5>
                                        <?= $address = $agent['agent_address'] ?>
                                        <?= $agent['agent_region'] . ',' . $agent['agent_district'] ?>
                                        <?= ' <br>' . $agent['agent_city'] . ', ' . $agent['agent_country']  ?>
                                        <?= '<br>' . $agent['agent_postal_code']; ?>
                                    </h5>
                                </td>
                                <td width="15%"> <br></td>
                                <td width="5%"><br></td>
                                <td width="30%"><br></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= '<br>' . @$agent['agent_phone'] ?></td>
                                <td>INVOICE NO</td>
                                <td>:</td>
                                <td><?= @$invoice[0]['invoice_number'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>INVOICE DATE</td>
                                <td>:</td>
                                <td><?= @$invoice[0]['invoice_date'] ?></td>
                            </tr>
                            <tr>
                            <tr>
                                <td></td>
                                <td> </td>
                                <td>SHIPMENT TYPE</td>
                                <td>:</td>
                                <td><?= @$invoice[0]['shipment_type'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <br />
                    <div class="col-md-12">
                        <table class="table" style="border:2px solid;">
                            <tbody>
                                <tr>
                                    <td>ORDER NO</td>
                                    <td>
                                        <?= @$invoice[0]['order_number'] ?>
                                    </td>
                                    <td>EX VESSEL</td>
                                    <td>
                                        <?= $invoice[0]['vessel'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CONTAINER NO</td>
                                    <td>
                                        <?= @$invoice[0]['container_no'] ?>
                                    </td>
                                    <td>MBL NO</td>
                                    <td>
                                        <?= @$invoice[0]['mbl_no'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>HBL NO</td>
                                    <td>
                                        <?= @$invoice[0]['hbl_no'] ?>
                                    </td>
                                    <td>SHIPPING</td>
                                    <td>
                                        <?= @$invoice[0]['shipper'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ETA</td>
                                    <td>
                                        <?= @$invoice[0]['eta'] ?>
                                    </td>
                                    <td>CONSIGNE</td>
                                    <td>
                                        <?= @$invoice[0]['consignee'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="box-header">
                            <div class="feebox">
                                <table class="table table-bordered" id="table_description" style="border:2px solid;">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <td rowspan="2" width="15%"><strong>Description</strong></td>
                                            <td rowspan="2" width="10%"><strong>QTY</strong></td>
                                            <td rowspan="2" width="10%"><strong>CURR</strong></td>
                                            <td rowspan="2" width="20%"><strong>Rate</strong></td>
                                            <td colspan="3" width="45%"><strong>IDR</strong></td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <td><strong>Amount</strong></td>
                                            <td><strong>VAT(1%)</strong></td>
                                            <td><strong>Total</strong></td>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach ($invoice as $row) {
                                        $id_row = $row['invoice_id'];

                                        echo  '<input name="invoice_id[]" class="form-control" readonly type="hidden" value="' . @$row['invoice_id'] . '">';
                                        echo '<tr>
                                                <td>
                                                    ' . $row['task_name'] . '
                                                </td> 
                                                <td style="text-align: center;">' . $row['quantity'] . '</td>
                                                <td style="text-align: center;">IDR</td>
                                                <td style="text-align: right;">' . $row['rate'] . '</td>
                                                <td style="text-align: right;">' . $row['amount'] . '</td>
                                                <td style="text-align: right;">' . $row['vat'] . '</td>
                                                <td style="text-align: right;">' . $row['total'] . '</td>
                                            </tr>';
                                    }
                                    ?>
                                    <tr id="" style="text-align: center;">
                                        <td colspan="4"><strong>TOTAL</strong></td>
                                        <td> 0</td>
                                        <td>0</td>
                                        <td><?= @$invoice[0]['grand_total'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <strong>IDR # : <i><?= strtoupper($this->tools->terbilang(@$invoice[0]['grand_total']))  ?> RUPIAH</i></strong>
                                        </td>
                                    </tr>
                                </table>

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
                    <a href="#" onclick="window.location.replace(' <?= site_url() . $temp_url  ?>');" class="btn btn-default pull-right"> Kembali</a>

                </div>
                <!--./col-md-12-->
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/ajax/3.4.1/jquery.min.js"></script>




<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function PrintElem(elem) {

        var printContents = document.getElementById(elem).innerHTML;
        Popup($(printContents).html());
    }

    function Popup(data) {
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link href="<?= base_url() ?>assets/templates/css/sb-admin-2.min.css" rel="stylesheet">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write('<div style="background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url("http://google.com"); background-repeat: no-repeat;background-position: center;">');
        frameDoc.document.write(data);
        frameDoc.document.write('<div>');
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
        return true;
    }
</script>