<script src="<?= base_url() ?>assets/swal/sweetalert.min.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css">

<link href="<?= base_url() ?>assets/login/style.css" rel="stylesheet">
<div class="main">


    <div class="container">
        <center>
            <div class="middle">
                <div id="login">

                    <form method="POST" action="<?= site_url("Login") ?>">

                        <fieldset class="clearfix">

                            <p><span class="fa fa-envelope-o "></span><input type="text" name='email' Placeholder="Email" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                            <p><span class="fa fa-lock"></span><input type="password" name='password' Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->

                            <div>
                                <!-- <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
                                        password?</a>
                                </span> -->
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Login"></span>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> <!-- end login -->
                <div class="logo">
                    <img src="<?= @$config['logo'] ?>" style="width: auto; height:75px;"></img>
                    <div class="clearfix"></div>
                </div>

            </div>
        </center>
    </div>

</div>

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