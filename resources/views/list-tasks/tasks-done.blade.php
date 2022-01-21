
@extends('list-tasks.master.main')


@section('content')
	<div class="bg-white px-3 pb-3">
		<table class="table table-striped mb-0">
			<thead class="thead-dark table-header">
			<tr>
				<th scope="col">ល.រ</th>
				<th scope="col">លេខកូដ</th>
				<th scope="col">ឈ្មោះអ្នកជម្ងឺ</th>
				<th scope="col">លេខទូរសព្ទ</th>
				<th scope="col">ខេត្ត/រាជធានី</th>
				<th scope="col">
					<div class="d-flex">
						មន្ទីរពេទ្យ
					</div>
				</th>
			</tr>
			</thead>
			<tbody>
			@if (count($patient))
				@foreach ($patient as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item->code }}</td>
						<td>
							{{ $item->name }}
							@permission('patients.work')
							<!-- @if($role_id==4)
								<a href="{{ route('interview',['id'=>$item->id]) }}">   {{ $item->name }} </a>
							@elseif($role_id==5)
								<a href="{{ route('list-tasks.show',['id'=>$item->id]) }}">   {{ $item->name }} </a>
							@endif
							@if($role_id==6)
								<a href="{{ route('list-tasks.show', $item->id) }}">   {{ $item->name }} </a>
							@endif -->
							@endpermission
						</td>
						<td>{{ $item->phone }}</td>
						<td>{{ $item->getProvince->name ?? '' }}</td>
						<td> {{ $item->hospital->value ?? ''}}</td>

					</tr>

				@endforeach
			@else
				<tr>
					<td colspan="15"><em>no records found</em></td>
				</tr>
			@endif
			</tbody>
		</table>
	</div>
@endsection
