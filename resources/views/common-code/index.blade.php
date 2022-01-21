@extends('layouts.app')

@section('page-title', "លេខកូដប្រព័ន្ធ")
@section('page-heading', " លេខកូដប្រព័ន្ធ")

@section('breadcrumbs')
    @if (isset($breadcrumbs))
        @foreach ($breadcrumbs as $bread)
            @if ($bread['isActive'])
                <li class="breadcrumb-item active">{{ $bread['label'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $bread['link'] }}">{{ $bread['label'] }}</a></li>
            @endif
        @endforeach
    @endif
@stop

@section('content')

    @include('partials.messages')

            <div class="header border-bottom-light">
                <div class="row mb-3 flex-md-row flex-column-reverse">
                    <div class="col-md-6">
                        @if (isset($breadcrumbs))
                        <h3 class="card-title">
                            {{ $breadcrumbs[count($breadcrumbs) - 1]['label'] }}
                        </h3>
                        @endif
                    </div>
                    <div class="col-md-6 text-right">
                        @if (auth()->user()->hasPermission('common-codes.create'))
                            @if (isset($parentCommonCode))
                            <a href="{{ route('common-codes.create') }}?parent_id={{ $parentCommonCode->id }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                @lang('បន្ថែម')
                            </a>
                            @else
                            <a href="{{ route('common-codes.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                @lang('បន្ថែម')
                            </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th class="min-width-150">Key</th>
                        <th class="min-width-150">Value</th>
                        <th class="min-width-80"># Children</th>
                        <th class="text-center min-width-150">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody class="sortable" data-url="{{ route('common-codes.update-order') }}">
                    @if ($commonCodes->count())
                        @foreach ($commonCodes as $index => $item)
                            <tr id="item_{{ $item->id }}">
                                <td><span><i class="fa fa-arrows-alt-v handler" style="cursor:pointer"></i></span></td>
                                <td class="align-middle no">{{ ($commonCodes->perPage() * ($commonCodes->currentPage() - 1)) + $index + 1 }}</td>
                                <td class="align-middle min-width-150">{{$item->key}}</td>
                                <td class="align-middle min-width-150">{{$item->value}}</td>
                                <td class="align-middle min-width-80">
                                    <a href="{{ route('common-codes.show', $item) }}">{{ $item->children_count }} តម្លៃ</a>
                                </td>
                                <td class="text-center">
                                    @if (auth()->user()->hasPermission('common-codes.edit'))
                                    <a href="{{ route('common-codes.edit', $item) }}" class="btn btn-icon border-primary"
                                        title="@lang('កែប្រែ')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif

                                    @if (auth()->user()->hasPermission('common-codes.destroy'))
                                    <a href="{{ route('common-codes.destroy', $item) }}" class="btn btn-icon border-danger"
                                        title="@lang('លុប')"
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
                            <td colspan="6"><em>@lang('No records found.')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        

    {!! $commonCodes->appends(\Request::except('page'))->render() !!}

@stop

@section('scripts')
    {!! HTML::script('assets/js/as/sortable.js') !!}
@stop
