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
            content: "";
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
 
        <div class="col-md-3"> 
            <div class="card widget">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="p-2 text-primary flex-1">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
    
                        <div class="pr-2">
                            <h2 class="text-center">{{ $dataentry }}</h2>
                            <div class="text-muted">@Lang('Dataentry')</div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        
        <div class="col-md-3"> 
            <div class="card widget">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="p-2 text-info flex-1">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
    
                        <div class="pr-2">
                            <h2 class="text-center">{{ $basic }}</h2>
                            <div class="text-muted">@Lang('Basic_interview')</div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <div class="col-md-3"> 
            <div class="card widget">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="p-2 text-warning flex-1">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
    
                        <div class="pr-2">
                            <h2 class="text-center">{{ $datatechnical }}</h2>
                            <div class="text-muted">@Lang('Datatechnical')</div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <div class="col-md-3">
            <div class="card widget"> 
                <div class="card-body shadow">
                    <div class="row">
                        <div class="p-2 text-success flex-1">
                            <i class="fa fa-users fa-2x"></i>  <!-- fa-user-slash -->
                        </div>

                        <div class="pr-2">
                            <h2 class="text-center">{{ $fullinterview }}</h2>
                            <div class="text-muted">@Lang('Full_interview')</div>
                        </div> 
                    </div>
                </div>
        </div>
    </div>

    </div>

    <div class="row">
        <div class="col-md-8">
            <table class="table tbl-info table-light shadow"  style="height: 300px;">
                <thead class="bg-primary">
                <tr>
                    <th>
                        ចំនួនកូនក្រុម​​ ({{ count($fullUser) }})
                    </th>

                    <th style="color: white;">
                        កំពុងសម្ភាស៍
                    </th>

                    <th>
                        សម្ភាស៍បាន
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <ul class="user-list list-unstyled">

                            @foreach($fullUser as $item)
                                <li>{{ $item->first_name .' '. $item->last_name }}</li>
                            @endforeach
                        </ul>
                    </td>

                    <td>
                        <ul class="user-list list-unstyled">
                            @foreach($fullUser as $item)
                                <li>{{ $item->countData }} នាក់</li>
                            @endforeach

                        </ul>
                    </td> 

                    <td>
                        <ul class="user-list list-unstyled">
                            @foreach($fullUser as $item)
                                <li>{{ $item->countData }} នាក់</li>
                            @endforeach

                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <table class="table tbl-info table-light shadow"  style="height: 300px;">
                <thead class="bg-primary">
                <tr>
                    <th>
                        @Lang('Superior_pie_chart_title') 
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

    <table class="table table-striped table-responsive-sm shadow rounded mt-2">
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

                @if (count($patients))
                    @foreach ($patients as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code }}</td>
                            <td><a href="{{ route('patient.superior.approve', $item->id) }}"> {{ $item->name }} </a></td>
                            <td>{{ $item->sex->value ?? '' }}</td>
                            <td>{{ $item->dob }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->getProvince->name ?? '' }}</td>
                            <td> {{ $item->hospital->value ?? ''}}</td>

                            <td>
                                <span class="badge {{ getTextColor($item->status) }} p-2 w-100">
                                    {{ getTextStatus($item->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button id="my-dropdown" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="my-dropdown">

                                        @permission('download.patient.report')
                                        @if($item->status == 4)
                                            <a href="{{ route('patients.download.report', $item->id) }}"
                                            class="dropdown-item text-gray"><i class="fas fa-edit mr-2"></i>
                                                @lang('downloadPatientReport')
                                            </a>
                                        @endif
                                        @endpermission

                                        @permission('patients.work')
                                        @if(auth()->user()->role_id==4)
                                            <a href="{{ route('interview',['id'=>$item->id]) }}"
                                            class="dropdown-item text-gray">
                                                <i class="fas fa-edit mr-2"></i>
                                                @lang('FirstInterview')
                                            </a>
                                        @endif
                                        @if(auth()->user()->role_id==5)
                                            <a href="{{ route('list-tasks.show',['id'=>$item->id]) }}"
                                            class="dropdown-item text-gray">
                                                <i class="fas fa-edit mr-2"></i>
                                                @lang('TechnicalInfo')
                                            </a>
                                        @endif
                                        @if(auth()->user()->role_id==6)
                                            <a href="{{ route("list-tasks.fullinterview",['id'=>$item->id]) }}"
                                            class="dropdown-item text-gray">
                                                <i class="fas fa-edit mr-2"></i>
                                                @lang('FullInterview')
                                            </a>
                                        @endif
                                        @endpermission

                                        @permission('patient.edit')
                                        @if($item->status == 1)
                                            <a href="{{ route('patients.edit',['id'=>$item->id]) }}" class="dropdown-item text-gray">
                                                <i class="fas fa-edit mr-2"></i>
                                                @lang('Edit')
                                            </a>
                                        @endif
                                        @endpermission
                                        @permission('patient.delete')
                                        @if($item->status == 1)
                                            <a data-toggle="modal" data-target="#exampleModal-{{$item->id}}" class="dropdown-item text-gray">
                                                <i class="fas fa-trash mr-2"></i>
                                                @lang('Delete')
                                            </a>
                                        @endif
                                        @endpermission
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        តើអ្នកចង់លុប "{{ $item->name }}" មែនទេ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ទេ</button>
                                        <a href="{{ route('patient.delete',['id'=>$item->id]) }}" type="button" class="btn btn-danger">បាទ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="15"><em>no records found</em></td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7" class="px-0">

                        {{ $patients->links() }}

                    </th>
                </tr>
            </tfoot>
    </table>
   
    @php
        $pie = $fullUser->toArray();
    @endphp

@stop
 
@section('scripts')

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script> 


        var done_full = <?php echo $done_full; ?>;
        var finist = <?php echo $finish; ?>;
        var research = <?php echo $research; ?>;
        
        $(document).ready(function(){

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['', ''],
                    ['', ''],
                    ['បិទករណី', 0],
                    ['', 0],
                    ['រួចរាល់', finist],
                    ['សម្ភាស៍បន្ថែម', 0],
                    ['', 0],
                    ['ស្រាវជ្រាវ', research],
                    ['សម្ភាស៍ពេញ', done_full],


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


    </script>

@endsection

@section('scripts')

@stop
