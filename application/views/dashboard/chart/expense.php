<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<!-- Resources -->

<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add data
        chart.data = <?= json_encode($expense) ?>;
        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        dateAxis.renderer.minGridDistance = 50;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "total";
        series.dataFields.dateX = "year_month";
        series.strokeWidth = 3;
        series.fillOpacity = 0.5;

        // Add vertical scrollbar
        chart.scrollbarY = new am4core.Scrollbar();
        chart.scrollbarY.marginLeft = 0;

        // Add cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "zoomY";
        chart.cursor.lineX.disabled = true;

    }); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>