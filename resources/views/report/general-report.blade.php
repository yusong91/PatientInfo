@extends('layouts.app')

@section('page-title', __('Patient Report'))
@section('page-heading', __('Patient Report')) 

<style>

.container {
  height: 200px;
  position: relative;
  border: 3px solid green;
}

    .vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

</style>

@section('styles')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
{{--    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>--}}
<!-- {{--    <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>--}} -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>

        .rounded {
            border-radius:.50rem!important
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        input[type="number"] {
            min-width: 50px;
        }
        .tbl-info {
            border-bottom-left-radius: .5rem;
            border-bottom-right-radius: .5rem;
        }
        .tbl-info thead th:first-child {
            border-top-left-radius: .5rem;
            color: #fff;
        }
        .tbl-info thead th:last-child {
            border-top-right-radius: .5rem;
            color: #fff;
        }
        .tbl-info tbody td:first-child {
            border-bottom-left-radius: .5rem;
        }
        .tbl-info tbody td:last-child {
            border-bottom-right-radius: .5rem;
        }
        .tbl-info td {
            vertical-align: top !important;
        }
        .user-list li {
            margin-bottom: .5rem;
        }
        .user-list li::before {
            content: "-";
            /* display: inline-block; */
            margin-right: 10px;
        }
    </style>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Patient Report')
    </li>
@stop
  
@section('content')

<div class="row"> 
    <div class="col-xl-3 col-md-6"> 
        <div class="card widget">
            <div class="card-body shadow">
                <div class="row">
                    <div class="p-2 text-danger flex-1">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
 
                    <div class="pr-2">
                        <h2 class="text-center">{{$patient_all}}</h2>
                        <div class="text-muted">@Lang('Total_patient')</div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget"> 
            <div class="card-body shadow">
                <div class="row">
                    <div class="p-2 text-danger flex-1">
                        <i class="fa fa-user fa-2x"></i>  <!-- fa-user-slash -->
                    </div>

                    <div class="pr-2">
                        <h2 class="text-center">{{$patient_daily}}</h2>
                        <div class="text-muted">@Lang('Total_patient_daily')</div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
 
    <div class="col-xl-3 col-md-6">
        <div class="card widget"> 
            <div class="card-body shadow">
                <div class="row">
                    <div class="p-2 text-primary flex-1">
                        <i class="fa fa-users fa-2x"></i>  <!-- fa-user-slash -->
                    </div>

                    <div class="pr-2">
                        <h2 class="text-center">{{$patient_death_all}}</h2>
                        <div class="text-muted">@Lang('Total_patient_death')</div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 ">
        <div class="card widget"> 
            <div class="card-body shadow">
                <div class="row">
                    <div class="p-2 text-primary flex-1">
                        <i class="fa fa-user fa-2x"></i>  <!-- fa-user-slash -->
                    </div>

                    <div class="pr-2">
                        <h2 class="text-center">{{$patient_death_daily}}</h2>
                        <div class="text-muted">@Lang('Total_patient_death_daily')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <table class="table tbl-info table-light shadow"  style="height: 300px;">
            <thead class="bg-primary">
                <tr>
                    <th>
                    @lang('Data_patient_4_day_later')
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div id="barchart_material" style="width: auto"></div>
                    </td>   
                </tr>
            </tbody>
        </table> 
    </div> 

    <div class="col-md-6">
        <table class="table tbl-info table-light shadow"  style="height: 300px;">
            <thead class="bg-primary">
                <tr>
                    <th>
                    @lang('Data_patient_dialy')
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <center> <div id="chart_action"></div></center>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    
    <div class="col-md-6">
        <table class="table tbl-info table-light shadow"  style="height: 300px;">
            <thead class="bg-primary">
                <tr>
                    <th>
                        @lang('total_gender_title') ( {{ $total_female + $total_male }} )
                    </th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;">
                            <div id="barchart_total_gender" style="width: auto;"></div>
                        </td>
                    </tr>
                </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table tbl-info table-light shadow"  style="height: 300px;">
            <thead class="bg-primary">
                <tr>
                    <th>
                        @lang('daily_gender_title') ( {{ $daily_female + $daily_male }} )
                    </th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;">
                            <div id="barchart_daily_gender" style="width: auto;"></div>
                        </td>
                    </tr>
                </tbody>
        </table>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <table class="table tbl-info table-light shadow"  style="height: 400px;">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            @lang('total_line_chart')
                        </th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;">
                                <div id="curve_chart" style="width: auto"></div>
                            </td>
                        </tr>
                    </tbody>
            </table> 
        </div>
</div>

@stop

@section('scripts')

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>  

    var data_bar_chart = <?php echo collect($data_bar_chart_past_day_all); ?>;
    var bar_chart = Array.from(data_bar_chart);

    var raw_data_variants = <?php echo collect($list_variants); ?>;
    var data_variants = Array.from(raw_data_variants);

    var data_pie_chart = <?php echo collect($data_bar_chart_past_day_0); ?>;
    var pie_chart = Array.from(data_pie_chart);
    
        var activeG = 2;
        var disableG = 2;
        var deactivateG = 2;
        var deactivateH = 2;
 
        $(document).ready(function(){

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                        pie_chart[0],
                        pie_chart[1],
                        pie_chart[3], //beta
                        pie_chart[4], //gumma
                        pie_chart[5],
                        ['', 0],
                        pie_chart[2]
                ]);

                var options = {
                    title: '',
                    backgroundColor: 'none',
                    legend: 'none',
                    chartArea: {width: 400, height: 300}
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_action'));
                chart.draw(data, options);
            }
        });
     
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
          data_variants,
          bar_chart[0],
          bar_chart[1],
          bar_chart[2]
        ]);
        var options = {
            chart: {
            title: '',
            subtitle: ''
        },
        legend: {position: 'none'},
            bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }


</script>

<script>

    var total_female = <?php echo $total_female; ?>;
    var total_male = <?php echo $total_male; ?>;

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        ["Female", total_female, "red"],
        ["Male", total_male, "blue"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 400,
        height: 200,
        
        bar: {groupWidth: "50%"},
        legend: { position: 'none' },
        backgroundColor: 'none',

      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_total_gender"));
      chart.draw(view, options);
  }
    
</script>

<script>

    var daily_female = <?php echo $daily_female; ?>;
    var daily_male = <?php echo $daily_male; ?>;

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        ["Female", daily_female, "red"],
        ["Male", daily_male, "blue"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 400,
        height: 200,
        bar: {groupWidth: "50%"},
        legend: { position: 'none' },
        backgroundColor: 'none',
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_daily_gender"));
      chart.draw(view, options);
  }
    
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Testing', 'Testing'],
          ['2004',  1000,      400],
          ['2005',  110070,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540],
          ['2007',  1030,      540]
        ]);

        var options = {
            title: '',
            curveType: 'function',
            legend: { position: 'bottom' },
            backgroundColor: 'none',
            width: "100%",
            height: 400,
            chartArea:{
                left:100,
                right:50,
                bottom:40,
                top:20,
                width:"100%",
                height:"100%"
            }
                        
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

@endsection

@section('scripts')

@stop
