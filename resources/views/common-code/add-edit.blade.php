@extends('layouts.app')

@section('page-title', "លេខកូដប្រព័ន្ធ")
@section('page-heading', isset($commonCode) ? __('កែប្រែ') : __('បង្កើត'))


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
    @if (isset($commonCode))
        <li class="breadcrumb-item active">{{ __('កែប្រែ').$commonCode->value }}</li>
    @else
        <li class="breadcrumb-item active">{{ __('បង្កើត') }}</li>
    @endif
@stop

@section('content')

@include('partials.messages')

@if (isset($commonCode))
    {!! Form::model($commonCode, ['route' => ['common-codes.update', $commonCode->id], 'method' => 'PUT', 'id' => 'common-code-form']) !!}
@else
    {!! Form::open(['route' => 'common-codes.store', 'id' => 'common-code-form']) !!}
@endif
    @csrf
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('កូដ និងតម្លៃ')
                    </h5>
                    <p class="text-muted">
                        @lang('សូមបញ្ចូលកូដ និងតម្លៃ')
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="key">@lang('កូដ') <span class="text-danger">*</span></label>
                                {!! Form::text('key', $commonCode->key ?? null, ['class' => 'form-control input-solid', 'id' => 'key']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="value">@lang('តម្លៃ') <span class="text-danger">*</span></label>
                                {!! Form::text('value', $commonCode->value ?? null, ['class' => 'form-control input-solid', 'id' => 'value']) !!}
                            </div>
                        </div>

                        @if (isset($commonCode))
                            {!! Form::hidden('parent_id', $commonCode->parent_id, ['class' => 'form-control input-solid', 'id' => 'parent_id']) !!}
                        @else
                            {!! Form::hidden('parent_id', isset($parentCommonCode) ? $parentCommonCode->id : 0, ['class' => 'form-control input-solid', 'id' => 'parent_id']) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __(isset($commonCode) ? 'កែប្រែ' : 'បង្កើត') }}
    </button>

{{ Form::close() }}

@stop

@section('scripts')
    @if (isset($locationCode))
        {!! JsValidator::formRequest('Vanguard\Http\Requests\CommonCode\UpdateRequest', '#common-code-form') !!}
    @else
        {!! JsValidator::formRequest('Vanguard\Http\Requests\CommonCode\CreateRequest', '#common-code-form') !!}
    @endif
@stop
