@extends('layouts.app')

@section('page-title', __('Patient Report'))
@section('page-heading', __('Patient Report'))

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
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-danger flex-1">
                        <i class="fa fa-users fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">...</h2>
                        <div class="text-muted">---</div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
 
    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-danger flex-1">
                        
                        <i class="fa fa-death"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">...</h2>
                        <div class="text-muted">...</div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget"> 
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fa fa-user fa-3x"></i>  <!-- fa-user-slash -->
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">...</h2>
                        <div class="text-muted">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-success flex-1">
                        <i class="fa fa-user fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">...</h2>
                        <div class="text-muted">...</div>
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
                        ចំនួនកូនក្រុម 
                    </th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <!-- <ul class="user-list list-unstyled"><li>test</li></ul> -->

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
                        ចំនួនកូនក្រុម 
                    </th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <center> <div id="chart_action"  style="padding:0px;"></div></center>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

    <table class="table table-striped table-responsive-sm m-3">
        <thead>
        <tr>
            <th scope="col">@lang('Num')</th>
            <th scope="col">@lang('PatCode')</th>
            <th scope="col">@lang('PatName')</th>
            <th scope="col">@lang('Gender')</th>
            <th scope="col">@lang('Dob')</th>
            <th scope="col">@lang('PatPhone')</th>
            <th scope="col">@lang('PatAdd')</th>
            <th scope="col">@lang('PatHospital')</th>
            <th scope="col">@lang('PatStatus')</th>
            <th scope="col" class="text-center">@lang('ActionGroup')</th>
        </tr>
        </thead>
        <tbody>
                <tr>
                    <td>test</td>
                </tr>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="7" class="px-0">
                test
            </th>
        </tr>
        </tfoot>
    </table>

@stop

@section('scripts')

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script> 

        var activeG = 2;
        var disableG = 2;
        var deactivateG = 2;
        
        $(document).ready(function(){

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['', ''],
                    ['', ''],
                    ['Disconnected', disableG],
                    ['Deactivate', deactivateG],
                    ['Connected', activeG] 
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
          ['Year', 'Total Patients', 'Death', 'Basic Interview', 'Data Technical', 'Full Interview'],
          ['2014', 1000, 400, 200,23 ,343],
          ['2015', 1170, 460, 250,223 ,343],
          ['2016', 660, 1120, 300,33 ,343],
          ['2017', 1030, 540, 350,33 ,343]
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

@endsection

@section('scripts')

@stop
