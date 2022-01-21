@extends('layouts.app')

@section('page-title', __('Users'))
@section('page-heading', __('Users'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Users')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::get('search') }}"
                               placeholder="@lang('Search for menus...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('users.index') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    
                </div>

                <div class="col-md-6">
                    <a href="{{ route('commoncode.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('app.create')
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th class="min-width-80">@lang('Description')</th>
                    <th></th>
                    
                </tr>
                </thead>
                <tbody>

                <?php $j = 0; ?> 

                @if(count($menus))
                    @foreach($menus as $item)
                        <?php $j++;  ?>

                        <tr>
                            <td>{{ $j }}</td>
                            <td>{{ $item->description }}</td>
						 <td>

                                <a href="{{ route('childmenu.create', 1) }}" class="btn btn-info btn-sm">song</a>


                                <a href=""
                                    class="btn btn-icon edit"
                                    title="Update"
                                    data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i> 
                                </a>
                                
                                <a href=""
                                        class="btn btn-icon"
                                        data-action=""
                                        title="Delete" 
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="@lang('app.please_confirm')"
                                        data-confirm-text="@lang('app.confirm_delete')"
                                        data-confirm-delete="@lang('app.yes_proceed')">
                                            <i class="fas fa-trash"></i>
                                </a>

                                
                            </td>

                        </tr>
                    @endforeach
                @else
                        <tr>
                            <td colspan="7"><em>@lang('app.no_records_found')</em></td>
                        </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



@stop



