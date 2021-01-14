<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left">
                <h1 class="h3 mb-0 text-gray-800">Filter Customer</h1>
            </div>
            <div class="float-right"><?= $this->tools->action('create') ?></div>
        </div>

        <div class="card-body">
            <form method='POST'>
                <div class="row">
                    <div class="col-md-10">
                        <span>Cari Kata Kunci</span>
                        <input name="search" class="form-control" value="<?= @$form['search'] ?>" />
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button class="btn btn-primary btn-block"> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>