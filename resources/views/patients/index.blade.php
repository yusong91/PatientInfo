@extends('layouts.app')

@section('page-title', __('Patient Info'))
@section('page-heading', __('Patient Info'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Patient Info')
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

<section class="row mb-3">
	<div class="col-md-3">
		<div class="input-group">
				<!-- <div class="input-group-prepend">
						<div class="input-group-text border-primary border bg-primary"> <i class="fa fa-search text-white"></i> </div>
				</div>
				<div class="form-floating">

					<input type="text" class="form-control border-primary" id="floatingSearch" placeholder="ស្វែងរកអ្នកជំងឺ">
				
					<label for="floatingSearch">@lang('Search')</label>
				</div> -->

				<form action="" method="GET"  accept-charset="UTF-8">
                        <div class="input-group custom-search-form">
                            <input  type="text"
                                        class="form-control input-solid"
                                        name="search"
                                        value="{{ Request::get('search') }}"
                                        placeholder="@lang('Search')"/>

                                        <span class="input-group-append">
                                              @if (Request::has('search') && Request::get('search') != '')
                                                <a href="{{ route('patients') }}" 
                                                class="btn btn-light d-flex align-items-center"
                                                role="button">
                                                    <i class="fas fa-times text-muted"></i>
                                                </a>
                                            @endif
                                            <button class="btn btn-light" type="submit" id="search-activities-btn">
                                                <i class="fas fa-search text-muted"></i>
                                            </button>
                                        </span>
                         			</div>
                            {{ csrf_field() }}
                    </form>
		</div>
	
	</div>
	<div class="col">
			<div class="btn-groups d-flex justify-content-end" role="group" aria-label="Vertical button group">
				@permission('patient.create')
					<a class="btn btn-primary" href="{{ route('patients.create') }}" > <i class="fas fa-user-plus"></i> @lang('AddPatient')</a>
				@endpermission
{{--				<a class="btn btn-primary" href="{{ route('form4') }}" >Go Step 4</a>--}}

{{--				@permission('patient.import')--}}
{{--					<a class="btn btn-outline-primary ml-3" href="{{ route('patients.import') }}" ><i class="far fa-file-excel"></i> @lang('AddExcel')</a>--}}
{{--				@endpermission--}}

				@permission('patient.excel')
					@livewire('patient-export-excel')
				@endpermission

				<a href="{{ route('patients.print') }}" class="btn btn-outline-primary ml-3"><i class="fas fa-print"></i> @lang('Print')</a>
			</div>
	</div>
</section>
<table class="table table-striped table-responsive-sm">
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
			<td>{{ $item->name }}</td>
			<td>{{ $item->sex->value ?? '' }}</td>
			<td>{{ $item->dob }}</td>
			<td>{{ $item->phone }}</td>
			<td>{{ $item->getProvince->name ?? '' }}</td>
			<td> {{ $item->hospital->value ?? ''}}</td>
			<td>

				<span class="badge {{ getTextColor($item->status_message) }} p-2 w-100">
					{{ getTextStatus($item->status_message, $item->process_by_step5) }}
				</span>

			</td>

			<td class="text-center">
				<div class="dropdown">
					<button id="my-dropdown" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
					<div class="dropdown-menu" aria-labelledby="my-dropdown">

						@permission('download.patient.report')
						@if($item->status == 4 || $item->status == 8 || $item->status == 9)
							<a href="{{ route('patients.download.report', $item->id) }}"
									class="dropdown-item text-gray"><i class="fas fa-edit mr-2"></i>
									@lang('downloadPatientReport')
							</a>
						@endif
						@endpermission

						@permission('patients.work')
							@if(auth()->user()->role_id==4 && $item->status != 4)
								<!-- <a href="{{ route('interview',['id'=>$item->id]) }}"
								   class="dropdown-item text-gray">
									<i class="fas fa-edit mr-2"></i>
									@lang('FirstInterview')
								</a> -->
							@endif
							@if(auth()->user()->role_id==5)
								<!-- <a href="{{ route('list-tasks.show',['id'=>$item->id]) }}"
								   class="dropdown-item text-gray">
									<i class="fas fa-edit mr-2"></i>
									@lang('TechnicalInfo')
								</a> -->
							@endif
							@if(auth()->user()->role_id==6)
								<!-- <a href="{{ route("list-tasks.fullinterview",['id'=>$item->id]) }}"
								   class="dropdown-item text-gray">
									<i class="fas fa-edit mr-2"></i>
									@lang('FullInterview')
								</a> -->
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

			<nav aria-label="Page navigation example">
					<ul class="pagination">

					<?php $page = $paginate->current_page; ?>

						@foreach ($paginate->links as $item)

							<?php $active = $item->label == $page ? 'active' : ''; ?> 

							<li class="page-item {{$active}}"><a class="page-link" href="{{ $item->url }}"><?php echo $item->label; ?></a></li>

						@endforeach 

					</ul>
				</nav>

			</th>
		</tr>
	</tfoot>
</table>

@stop