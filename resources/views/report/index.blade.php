@extends('layouts.app')

@section('page-title', __('Report'))
@section('page-heading', __('Report'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Report')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <style>
        .form-floating .form-control {
            border-radius: 0 0.25rem 0.25rem 0;
        }
        .input-group .form-floating .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem;
        }
        .input-group .input-group-text {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: .25rem;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
    </style>

    <section class="row mb-5">
       <h1>Report</h1>
    </section>

@stop