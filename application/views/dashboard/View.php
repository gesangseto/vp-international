<div class="container-fluid">

  <!-- Page Heading -->

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= site_url('sumber_daya_manusia/daftar_staf') ?>">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengguna</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$count_user ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= site_url('sumber_daya_manusia/daftar_staf') ?>">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agent</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$count_agent ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user-lock fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= site_url('sumber_daya_manusia/daftar_staf') ?>">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Customer</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$count_customer ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= site_url('informasi_siswa/detail_siswa') ?>">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Port</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= @$count_port ?></div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-child fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Pending Requests Card Example -->

  </div>

  <!-- Content Row -->

  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pengeluaran Global</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body" id="expense_chart">
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script>
  $(document).ready(function() {
    // LOAD CONTENT CHART ONLINE EXAM
    $.ajax({
      type: "POST",
      url: "<?= site_url() ?>Dashboard_ajax/chart_expense",
      success: function(isi) {
        $('#expense_chart').html(isi);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError);
      }
    });
  });
</script>