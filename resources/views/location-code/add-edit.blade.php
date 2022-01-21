@extends('layouts.app')

@section('page-title', __('លេខកូដតំបន់'))
@section('page-heading', isset($locationCode) ? __('កែប្រែ') . $locationCode->name : __('បង្កើតលេខកូដតំបន់ថ្មី'))

@section('breadcrumbs')

    @if (isset($locationCode))
        <li class="breadcrumb-item active">{{ __('កែប្រែ').$locationCode->name }}</li>
    @else
        <li class="breadcrumb-item active">{{ __('បង្កើត') }}</li>
    @endif
@stop

@section('content')

@include('partials.messages')

@if (isset($locationCode))
    {!! Form::model($locationCode, ['route' => ['location.update', $locationCode->id], 'method' => 'PUT', 'id' => 'location-code-form']) !!}
@else
    {!! Form::open(['route' => 'location.store', 'id' => 'location-code-form','method' => 'POST']) !!}
@endif

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('តំបន់')
                </h5>
                <p class="text-muted">
                    @lang('ព័ត៌មានទូទៅសម្រាប់លេខកូដតំបន់')
                </p>
            </div>
            <div class="col-md-9">
                <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">@lang('label.name')</label>
                                {!! Form::text('name', $locationCode->name ?? "", ['class' => 'form-control input-solid', 'id' => 'name']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province_code">@lang('label.province')</label>
                                {!! Form::text('province_code', $locationCode->province_code ?? "" , ['class' => 'form-control input-solid', 'id' => 'province_code']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="distict_code">@lang('label.district')</label>
                                {!! Form::text('distict_code', $locationCode->distict_code ?? "" , ['class' => 'form-control input-solid', 'id' => 'distict_code']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="commune_name">@lang('label.commune')</label>
                                {!! Form::text('communce_code',$locationCode->communce_code ?? ""  , ['class' => 'form-control input-solid', 'id' => 'commune_name']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="village_code">@lang('label.village')</label>
                                {!! Form::text('village_code', $locationCode->village_code ?? "" , ['class' => 'form-control input-solid', 'id' => 'village_code']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">@lang('label.code')</label>
                                {!! Form::text('code', $locationCode->code ?? "" , ['class' => 'form-control input-solid', 'id' => 'code']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">@lang('label.type')</label>
                                {!! Form::text('type', $locationCode->type ?? "" , ['class' => 'form-control input-solid', 'id' => 'type']) !!}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    {{ __(isset($locationCode) ? 'កែប្រែ' : 'បង្កើត') }}
</button>

@stop

@section('scripts')
    @if (isset($locationCode))
        {!! JsValidator::formRequest('Vanguard\Http\Requests\LocationCode\UpdateLocationCodeRequest', '#location-code-form') !!}
    @else
        {!! JsValidator::formRequest('Vanguard\Http\Requests\LocationCode\CreateLocationCodeRequest', '#location-code-form') !!}
    @endif
@stop
