<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left">
                <h1 class="h3 mb-0 text-gray-800">Filter User</h1>
            </div>
            <div class="float-right"><?= $this->tools->action('create') ?></div>
        </div>

        <div class="card-body">
            <form method='POST'>
                <div class="row">
                    <div class="col-md-4">
                        <label>Poisisi</label>
                        <select id="position_id" name="position_id" class="form-control">
                            <option selected value="" disabled class="form-control">pilih</option>
                            <?php
                            if ($position)
                                foreach ($position as $row) { ?>
                                <option <?= @$form['position_id'] == $row['id'] ? 'selected' : '' ?> value="<?= $row['id'] ?>" class="form-control"><?= $row['position_name'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Jenis Kelamin</label>
                        <select id="gender" name="gender" class="form-control">
                            <option selected value="" disabled class="form-control">pilih</option>
                            <option value="male" class="form-control">Laki laki</option>
                            <option value="female" class="form-control">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Cari Kata Kunci</label>
                                <input name="search" class="form-control" value="<?= @$form['search'] ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button class="btn btn-primary btn-block"> Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>