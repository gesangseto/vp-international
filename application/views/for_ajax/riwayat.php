<style>
    .table-condensed {
        font-size: 10px;
    }
</style>
<br />
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed">
                    <br>
                    <tbody>
                        <tr>
                            <td><strong> Waktu Check</strong></td>
                            <td><strong> Tempat</strong></td>
                        </tr>
                        <?php
                        foreach ($riwayat as $rslt) {
                        ?>
                            <tr>
                                <td> <?= $rslt['time_in_out'] ?> </td>
                                <td> <?= $rslt['location'] ?> </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

        </div>
    </div>
</div>