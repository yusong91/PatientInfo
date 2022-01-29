@extends('layouts.app')

@section('page-title', __('Setting Report'))
@section('page-heading', __('Setting Report'))

@section('styles')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.min.js"></script>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
{{--    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>--}}


    <style> 
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
        <div class="col-md-6">
            <table class="table tbl-info table-light shadow">
                <thead class="bg-primary">
                <tr>
                    <th>
                        ចំនួនកូនក្រុម
                    </th>
                    <th>
                        អ្នកជំងឺបានសម្ភាស៍
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <ul class="user-list list-unstyled">

                                <li>@lang('Added')</li>
                                <li>@lang('FirstInterview')</li>
                                <li>@lang('TechnicalInfo')</li>
                                <li>@lang('FullInterview')</li>
                                <li>ស្លាប់</li>
                                <li>ស្រាវជ្រាវ</li>

                        </ul>
                    </td>
                    <td>
                        <ul class="user-list list-unstyled">

                                <li>{{ $dataentry }} នាក់</li>
                                <li>{{ $basic }} នាក់</li>
                                <li>{{ $datatechnical }} នាក់</li>
                                <li>{{ $fullinterview }} នាក់</li>
                                <li>{{ $death }} នាក់</li>
                                <li>{{ $research }} នាក់</li>

                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="col-xl-6" style="margin-top: 30px;">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>

            </div>
        </div>
    </div>


@stop

@section('scripts')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script type="text/javascript">
        var dataentry = <?php echo json_encode($dataentry); ?>;
        var basic = <?php echo json_encode($basic); ?>;
        var datatechnical = <?php echo json_encode($datatechnical); ?>;
        var fullinterview = <?php echo json_encode($fullinterview); ?>;
        var death = <?php echo json_encode($death); ?>;
        var research = <?php echo json_encode($research); ?>;

        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'សង្ខេប'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [
                    {"name":"ទើបតែបញ្ចូល","y":dataentry},
                    {"name":"សម្ភាសន៍បឋម","y":basic},
                    {"name":"ទិន្នន័យបច្ចេកទេស","y":datatechnical},
                    {"name":"សំភាសពេញ","y":fullinterview},
                    {"name":"ស្លាប់","y":death},
                    {"name":"ស្រាវជ្រាវ","y":research},
                ]
            }]
        });
    </script>

@endsection