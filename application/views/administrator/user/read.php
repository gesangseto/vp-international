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
                    <h1 class="h3 mb-0 text-gray-800"><?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="content-wrapper" style="min-height: 946px;">
                <!-- Main content -->
                <section class="content">
                    <div class="row">



                        <!--./col-md-3-->
                        <div class="col-md-12">
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
                                            <a class="nav-link" href="#Riwayat" onclick="riwayat(<?= $this->session->userdata('id') ?>);" role="tab" data-toggle="tab">Riwayat</a>
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
                                                                <td><strong> Nomor Induk Karyawan </strong></td>
                                                                <td class="mailbox-name"> <?= $form['employee_no'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Nama Lengkap </strong></td>
                                                                <td class="mailbox-name"> <?= $form['fullname'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Jenis Kelamin</strong></td>
                                                                <td class="mailbox-name"> <?= $form['gender'] ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong> Agama </strong></td>
                                                                <td class="mailbox-name"> <?= $form['religion'] ?> </td>
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
                                                                <td><strong> Nomor Telpon </strong></td>
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
                                            <input type="text" readonly value="Tidak ada riwayat" id="inputRiwayat" class="form-control" />
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


<!-- /.container-fluid -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script>
    function riwayat(id, class_id, section_id) {
        // console.log($('#InputSaudaraKandung').val())
        if ($('#inputRiwayat').val()) {
            $.ajax({
                type: 'POST',
                url: '<?= site_url("user/Ajax_data/get_saudara_kandung") ?>',
                data: {
                    id: id,
                    class_id: class_id,
                    section_id: section_id,
                },
                success: function(isi) {
                    $('#SaudaraKandung').html(isi);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(thrownError); // Munculkan alert error
                }
            });
        }
    }
</script>