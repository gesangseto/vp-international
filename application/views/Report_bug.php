<?php
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
function convertDateTime($date, $format = 'Y-m-d')
{
    $tz1 = 'UTC';
    $tz2 = 'Antarctica/Davis'; // UTC +7
    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));
    return $d->format($format);
}
?>
<div class="container-xl">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="h3 mb-0 text-gray-800"><?= ucwords(str_replace('_', ' ', $this->router->fetch_class())); ?></h1>
                </div>
            </div>

        </div>
        <div class="card-body">
            <form action='<?= site_url() . $controller  ?>' method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="exampleFormControlInput1">Tanggal Temuan</label> <small> *</small>
                        <input type="date" required name="date" value="<?= @convertDateTime(date('Y-m-d')) ?>" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlInput1">URL</label> <small> *</small>
                        <input type="text" required name="url" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlInput1">Lampirkan Tangkapan Layar</label>
                        <input type="file" id="file" required name="screenshoot" class="form-control">
                    </div>
                    <div class="col-sm-12">
                        <label for="exampleFormControlInput1">Deskripsi Error</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            Kirim
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?= site_url() . $temp_url  ?>" class="btn btn-secondary btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $("#file").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        console.log(fileType)
        var size = +file.size / 1000;
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]))) {
            alert('Sorry, only JPEG adn PNG files are allowed to upload.');
            $("#file").val('');
            return false;
        } else if (size > 500) {
            alert('Sorry, maximum file to upload is 500 Kb.');
            $("#image").val('');
            return false;
        }
    });
</script>