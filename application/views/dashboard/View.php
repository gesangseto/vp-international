<div class="container-fluid">


  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Seluruh Anggota</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$result[0]['total'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Anggota Aktif</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$result[0]['total_active'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Anggota Tidak Aktif</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$result[0]['total_non_active'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-lock fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->

    <!-- Pending Requests Card Example -->

  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Jumlah Kalkulasi</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div id="jumlahSiswa"></div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Jenis Kelamin</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">

          <div id="chartdiv"></div>
        </div>
      </div>
    </div>
  </div>


</div>



<script src="<?= base_url() ?>assets/templates/vendor/chart.js/Chart.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/templates/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>assets/templates/js/demo/chart-pie-demo.js"></script> -->

<!-- Styles 
  -->
<style>
  #chartdiv {
    width: 100%;
    height: 500px;
  }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = [{
        country: "Laki-laki",
        value: <?= @$result[0]['total_male'] ?>
      },
      {
        country: "Perempuan",
        value: <?= @$result[0]['total_female'] ?>
      }
    ];

    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "value";
    series.dataFields.radiusValue = "value";
    series.dataFields.category = "country";
    series.slices.template.cornerRadius = 6;
    series.colors.step = 3;

    series.hiddenState.properties.endAngle = -90;

    chart.legend = new am4charts.Legend();

  }); // end am4core.ready()
</script>



<style>
  #jumlahSiswa {
    width: 100%;
    height: 500px;
  }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->


<script>
  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("jumlahSiswa", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = <?= json_encode($info_student_by_class['data'], true) ?>

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "class";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "total";
    series.dataFields.categoryX = "class";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

  }); // end am4core.ready()
</script>

<!-- HTML -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js">
</script>
<script>
  $(document).ready(function() {
    $("#province").change(function() {
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?= site_url() ?>administrator/ajax_data/get_regency", // Isi dengan url/path file php yang dituju
        data: {
          province_id: $("#province").val()
        },
        success: function(isi) {
          $('#regency').html(isi);
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(thrownError); // Munculkan alert error
        }
      });
    });
    $("#regency").change(function() {
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?= site_url() ?>administrator/ajax_data/get_district", // Isi dengan url/path file php yang dituju
        data: {
          regency_id: $("#regency").val()
        },
        success: function(isi) {
          $('#district').html(isi);
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(thrownError); // Munculkan alert error
        }
      });
    });
    $("#district").change(function() {
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?= site_url() ?>administrator/ajax_data/get_village", // Isi dengan url/path file php yang dituju
        data: {
          district_id: $("#district").val()
        },
        success: function(isi) {
          $('#village').html(isi);
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(thrownError); // Munculkan alert error
        }
      });
    });
  });
</script>