@extends('layouts.app')

@section('page-title', __('លេខកូដតំបន់'))
@section('page-heading', __('លេខកូដតំបន់'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ __('លេខកូដតំបន់') }}</li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="header border-bottom-light">
                <div class="row mb-3 flex-md-row flex-column-reverse">
                    <div class="col-md-6">

                        <h3 class="card-title">
                            {{__('លេខកូដតំបន់')}}
                        </h3>

                    </div>
                    <div class="col-md-6">
                        @if (auth()->user()->hasPermission('location.create'))
                            @if (isset($parentLocationCode))
                            <a href="{{ route('location.create') }}?parent_code={{ $parentLocationCode->code }}" class="btn btn-primary btn-rounded float-right">
                                <i class="fas fa-plus mr-2"></i>
                                @lang('បន្ថែម')
                            </a>
                            @else
                            <a href="{{ route('location.create') }}" class="btn btn-primary btn-rounded float-right">
                                <i class="fas fa-plus mr-2"></i>
                                @lang('បន្ថែម')
                            </a>
                            @endif
                            <button id="btn-open-import-modal" type="button" class="btn btn-primary btn-rounded float-right mr-2" data-toggle="modal" data-target="#import-modal">
                                <i class="fas fa-file-excel mr-2"></i>
                                @lang('Import')
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="location-codes-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-150">@lang('label.code')</th>
                        <th class="min-width-150">@lang('label.name')</th>
                        <th class="min-width-150">
                                @lang('label.province')
                        </th>
                        <th class="min-width-150">
                            @lang('label.district')

                        </th>
                        <th class="min-width-150">
                                @lang('label.commune')
                        </th>
                        <th class="min-width-150">
                                @lang('label.village')
                        </th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($locationCodes) && count($locationCodes))
                            @foreach ($locationCodes as $index => $locationCode)
                                <tr>
                                    <td>{{ $locationCode->code }}</td>
                                    <td>{{ $locationCode->name }}</td>
                                    <td>{{ $locationCode->province_code }}</td>
                                    <td>{{ $locationCode->distict_code }}</td>
                                    <td>{{ $locationCode->communce_code }}</td>
                                    <td>{{ $locationCode->village_code }}</td>

                                    <td class="text-center">
                                        @if (auth()->user()->hasPermission('location.edit'))
                                        <a href="{{ route('location.edit', $locationCode) }}" class="btn btn-icon border-primary"
                                           title="@lang('Edit Location Code')" data-toggle="tooltip" data-placement="top">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        @if (auth()->user()->hasPermission('location.delete'))
                                        <a href="{{ route('location.destroy', $locationCode) }}" class="btn btn-icon border-danger"
                                            title="@lang('Delete Location Code')"
                                            data-icon="warning"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            data-method="DELETE"
                                            data-confirm-title="@lang('តើអ្នកប្រាកដក្នុងការលុបទិន្នន័យនេះមែនទេ?')"
                                            data-confirm-text="@lang('អនុទិន្នន័យទាំងអស់នឹងត្រូវលុបចោលពីប្រព័ន្ធដោយស្វ័យប្រវត្តិ')"
                                            data-confirm-delete="@lang('លុប')"
                                            data-button-cancel-text="@lang('បោះបង់')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6"><em>@lang('មិនមានទិន្នន័យ')</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $locationCodes->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">@lang('Import លេខកូដតំបន់')</h5>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{ route('location.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">@lang('ឯកសារទម្រង់ Excel') <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control-file" id="file" accept=".xlsx,.xls" multiple>
                    </div>
                </form>
                <div class="text-center mt-2 mb-2" id="message"></div>
                <div id="loading-indicator" class="loading-indicator text-center d-none">
                    <div class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-close" type="button" class="btn btn-danger" data-dismiss="modal">@lang('បោះបង់')</button>
                <button id="btn-submit" type="button" class="btn btn-primary" form="file-form">Import</button>
            </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    {!! HTML::script('assets/js/as/swal.js') !!}
    {!! HTML::script('assets/js/as/import.js') !!}
@stop
