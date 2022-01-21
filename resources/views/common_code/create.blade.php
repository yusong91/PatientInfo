@extends('layouts.app')

@section('page-title', __('Add User'))
@section('page-heading', __('Create New User'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">@lang('Users')</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create')
    </li>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'commoncode.store', 'files' => true, 'id' => 'user-form']) !!}

    <div class="card">
        <div class="card-body">

        <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Menu</label>                 
                    <input type="text" class="form-control" required name="description">
                                     
                </div>
                
                {{ csrf_field() }}                
        </div>
        <button style="margin-bottom: 10px;" type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop
