<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SC - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/templates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico">
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/templates/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/swal/sweetalert.min.js"></script>

</head>
<!-- SWAL Fire -->



<body style="background-image: url('<?= base_url('assets/background.jpg') ?>');">
    <div class="container">
        <!-- SWAL Fire -->

        <?php
        function convertDateTime($date, $format = 'Y-m-d')
        {
            $tz1 = 'UTC';
            $tz2 = 'Antarctica/Davis'; // UTC +7
            $d = new DateTime($date, new DateTimeZone($tz1));
            $d->setTimeZone(new DateTimeZone($tz2));
            return $d->format($format);
        }
        ?>

        <!-- style timeline -->
        <style>
            .timeline {
                list-style: none;
                padding: 0 0 20px;
                position: relative;
                margin-top: -15px
            }

            .timeline:before {
                top: 30px;
                bottom: 25px;
                position: absolute;
                content: " ";
                width: 3px;
                background-color: #ccc;
                left: 25px;
                margin-right: -1.5px
            }

            .timeline>li,
            .timeline>li>.timeline-panel {
                margin-bottom: 5px;
                position: relative
            }

            .timeline>li:after,
            .timeline>li:before {
                content: " ";
                display: table
            }

            .timeline>li:after {
                clear: both
            }

            .timeline>li>.timeline-panel {
                margin-left: 55px;
                float: left;
                top: 19px;
                padding: 4px 10px 8px 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 650px
            }

            .timeline>li>.timeline-badge {
                color: #fff;
                width: 36px;
                height: 36px;
                line-height: 36px;
                font-size: 1.2em;
                text-align: center;
                position: absolute;
                top: 26px;
                left: 9px;
                margin-right: -25px;
                background-color: #fff;
                z-index: 100;
                border-radius: 50%;
                border: 1px solid #d4d4d4
            }

            .timeline>li.timeline-inverted>.timeline-panel {
                float: left
            }

            .timeline>li.timeline-inverted>.timeline-panel:before {
                border-right-width: 0;
                border-left-width: 15px;
                right: -15px;
                left: auto
            }

            .timeline>li.timeline-inverted>.timeline-panel:after {
                border-right-width: 0;
                border-left-width: 14px;
                right: -14px;
                left: auto
            }

            .timeline-badge.primary {
                background-color: #2e6da4 !important
            }

            .timeline-badge.success {
                background-color: #3f903f !important
            }

            .timeline-badge.warning {
                background-color: #f0ad4e !important
            }

            .timeline-badge.danger {
                background-color: #d9534f !important
            }

            .timeline-badge.info {
                background-color: #5bc0de !important
            }

            .timeline-title {
                margin-top: 0;
                color: inherit
            }

            .timeline-body>p,
            .timeline-body>ul {
                margin-bottom: 0;
                margin-top: 0
            }

            .timeline-body>p+p {
                margin-top: 5px
            }

            .timeline-badge>.glyphicon {
                margin-right: 0px;
                color: #fff
            }

            .timeline-body>h4 {
                margin-bottom: 0 !important
            }

            .table-condensed {
                font-size: 12px;
            }
        </style>


        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 ">

                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="h3 mb-0 text-gray-800">Data</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="content-wrapper" style="min-height: 946px;">
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="box box-primary">
                                                <div class="box-body text-center">
                                                    <img src="<?= base_url('uploads/photo/' . @$form['photo']) ?>" class="img-thumbnail" width="304" height="236">
                                                    <br />
                                                    <br />
                                                    <table class="table table-bordered table-hover table-condensed">
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> Nama </strong></td>
                                                                <td class="mailbox-name"> <?= $form['fullname'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> No Anggota </strong></td>
                                                                <td class="mailbox-name"> <?= $form['member_no'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> Posisi </strong></td>
                                                                <td class="mailbox-name"> <?= $form['position_name'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;" colspan="2"><strong> Wilayah </strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> DPW </strong></td>
                                                                <td class="mailbox-name"> <?= $form['province_name'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> DPD </strong></td>
                                                                <td class="mailbox-name"> <?= $form['regency_name'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> DPK </strong></td>
                                                                <td class="mailbox-name"> <?= $form['district_name'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left;"><strong> Rating </strong></td>
                                                                <td class="mailbox-name"> <?= $form['village_name'] ?> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <!--./col-md-3-->
                                <div class="col-md-9">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <div class="box-tools pull-right">
                                                <div class="has-feedback">
                                                    <!-- Button to trigger modal -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">

                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#Profil" role="tab" data-toggle="tab">Profil</a>
                                                </li>
												
												<li class="nav-item">
													<a class="nav-link" href="#Riwayat" onclick="showRiwayat(<?= @$form['id'] ?>);" role="tab" data-toggle="tab">Riwayat</a>
												</li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#qrCode" role="tab" data-toggle="tab">QR Code</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">

                                                <div role="tabpanel" class="tab-pane active" id="Profil">
                                                    <div class="row">
                                                        <div class="table-responsive mailbox-messages">
                                                            <table class="table table-bordered table-hover">
                                                                <br>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center;" bgcolor="lightgrey"><strong> Informasi Umum </strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Tanggal Gabung </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['join_date'] ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Tempat Lahir </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['pob'] ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Tanggal Lahir </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['dob'] ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Nomot Telpon </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['phone_number'] ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Email </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['email'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Agama </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['religion'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong> Alamat </strong></td>
                                                                        <td class="mailbox-name"> <?= $form['address']  ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                    </div>
                                                </div>

												<div role="tabpanel" class="tab-pane" id="Riwayat">
													<br />
													<input type="text" readonly value="Tidak ada riwayat" id="InputRiwayat" class="form-control" />
												</div>

                                                <div role="tabpanel" class="tab-pane" id="qrCode">
                                                    <br />
                                                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= site_url('qrcode/read?unique_code=' . $form['unique_code']) ?>" title="Link to Google.com" />
                                                </div>

                                            </div>
                                            <!-- END TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>


                </div>

            </div>
        </div>
    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/templates/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/templates/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/templates/js/sb-admin-2.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
function showRiwayat(id) {
        $.ajax({
            type: 'POST',
            url: '<?= site_url("Profile/get_riwayat") ?>',
            data: {
                id: id
            },
            success: function(isi) {
                $('#Riwayat').html(isi);
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(thrownError); // Munculkan alert error
            }
        });
    }

</script>
<!-- /.container-fluid -->
</body>

</html>


<?php
if (isset($response)) {
    if ($response['statusCode'] == '200') {
        echo '<script>
        swal("' . $response['messages'] . '", "", "success")
                </script>';
    } else {
        echo '
        <script> swal("' . $response['messages'] . '", "", "error");</script>';
    }
}
?>