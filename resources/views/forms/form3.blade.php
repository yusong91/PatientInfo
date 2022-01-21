@extends('layouts.app')

@section('content')
<style>
	.table tr {
		display: table;
		width: 100%;
		table-layout: fixed;
	}
	.table tr th:nth-child(1),
	.table tr td:nth-child(1) {
		width: 50px;
	}
	.table tr th:nth-child(2),
	.table tr td:nth-child(2),
	.table tr th:nth-child(3),
	.table tr td:nth-child(3) {
		width: 200px;
	}
	.table tr th:nth-child(4),
	.table tr td:nth-child(4) {
		width: 250px;
	}

</style>
<section>
	<nav aria-label="Page breadcrumb">
		<ol class="breadcrumb form-steps col-md-10 mx-auto">
			<div class="line"></div>
			<li class="breadcrumb-item"><span>1</span>@lang('PatientInfo')</li>
			<li class="breadcrumb-item"><span>2</span>@lang('FirstInterview')</li>
			<li class="breadcrumb-item active" aria-current="page"><span>3</span>@lang('TechnicalInfo')</li>
			<li class="breadcrumb-item"><span>4</span>@lang('FullInterview')</li>
		</ol>
	</nav>

	<form action="">
		<label>@lang('TechnicalLocation')</label>

		<!-- Map Section -->
		<div class="embed-responsive embed-responsive-21by9 bg-light mt-3 mb-5">
			<iframe class="embed-responsive-item" src=""></iframe>
		</div>
		<!-- / Map Section -->

		<div class="d-flex align-items-center mb-3">
			<span>
				<label class="align-self-center">@lang('BTSPlace')</label>
				{{-- <button class="btn btn-link ml-auto">@lang('DownloadExcel')</button> --}}
			</span>
			<div class="custom-file ml-auto w-auto">
				<input id="my-input" class="custom-file-input" type="file" name="">
				<label for="my-input" class="custom-file-label">Upload Excel</label>
			</div>
			<button type="submit" class="btn btn-primary ml-3">Submit</button>
		</div>
		<table class="table table-responsive-sm table-striped mb-5">
			<thead>
				<tr>
					<th scope="row">#</th>
					<th scope="row">Time</th>
					<th scope="row">Date</th>
					<th scope="row">LatLong</th>
					<th scope="row">Address BTS</th>
				</tr>
			</thead>
			<tbody class="d-block" style="overflow: scroll; max-height: 250px">
				<tr>
					<td>1</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>2</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>3</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
				<tr>
					<td>4</td>
					<td>10:30 am</td>
					<td>2021-08-27</td>
					<td>11.52898, 104.99336</td>
					<td>On rooftop of #442,St.Monireth, Sangkat Steung Meanchey</td>
				</tr>
			</tbody>
		</table>

		<div class="d-flex align-items-center mb-3">
		<span>
			<label class="align-self-center">@lang('QRPlace')</label>
			{{-- <button class="btn btn-link">@lang('DownloadExcel')</button> --}}
		</span>
			<div class="custom-file ml-auto w-auto">
				<input id="my-input" class="custom-file-input" type="file" name="">
				<label for="my-input" class="custom-file-label">Upload Excel</label>
			</div>
			<button type="submit" class="btn btn-primary ml-3">Submit</button>
		</div>
		<table class="table table-responsive-sm table-striped">
			<thead>
				<tr>
					<th scope="row">@lang('Num')</th>
					<th scope="row">@lang('date')</th>
					<th scope="row">@lang('ShopName')</th>
					<th scope="row">@lang('ShopPhone')</th>
					<th scope="row">@lang('ShopEmail')</th>
					<th scope="row">@lang('ShopAdd')</th>
				</tr>
			</thead>
			<tbody class="d-block" style="overflow: scroll; max-height: 250px">
				<tr>
					<td>1</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>2</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>3</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
				<tr>
					<td>4</td>
					<td>2021-08-27 10:30 am</td>
					<td>C++ Coffee</td>
					<td>012 345 678</td>
					<td>semnavy70@gmail.com</td>
					<td>ភ្នំពេញ</td>
				</tr>
			</tbody>
		</table>
	</form>

</section>

@stop

@section('scripts')
<script>
	$('#checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date').datepicker({
			uiLibrary: 'bootstrap4'
	});
</script>
@stop