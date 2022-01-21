@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{url('assets/css/datatables.css')}}">
		
@endsection
@section('content')
<style>
	.dataTables_info {
		display: none;
	}
</style>
<section>
	<nav aria-label="Page breadcrumb">
		<ol class="breadcrumb form-steps col-md-10 mx-auto">
			<div class="line"></div>
			<li class="breadcrumb-item"><span>1</span>@lang('PatientInfo')</li>
			<li class="breadcrumb-item"><span>2</span>@lang('FirstInterview')</li>
			<li class="breadcrumb-item" aria-current="page"><span>3</span>@lang('TechnicalInfo')</li>
			<li class="breadcrumb-item active"><span>4</span>@lang('FullInterview')</li>
		</ol>
	</nav>

	<form action="">
		<!-- Patient info -->
		<fieldset>
			<legend>@lang('PatientInfo')</legend>
			<div class="row mb-4">
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingPatientName" placeholder="@lang('PatientName')">
						<label for="floatingPatientName">@lang('PatientName')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<select class="form-control" id="floatingGender" placeholder="@lang('Gender')">
							<option>@lang('Gender')</option>
						</select>
						<label for="floatingGender">@lang('Gender') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingAge" placeholder="@lang('Age')">
						<label for="floatingAge">@lang('Age')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<select class="form-control" id="floatingNational" placeholder="@lang('Nationality')">
							<option>សញ្ជាតិ</option>
						</select>
						<label for="floatingNational">@lang('Nationality') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group mb-3">
						<div class="form-floating">
							<input type="text" id="floatingLastRelated" class="form-control" placeholder="@lang('Last Related')">
							<label for="floatingLastRelated">@lang('Last Related')<span class="text-danger">*</span></label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNumber (req)') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<select class="form-control" id="floatingNational" placeholder="@lang('Other')">
							<option>@lang('Other')</option>
						</select>
						<label for="floatingNational">@lang('Other')</label>
					</div>
				</div>
			</div>
			<label class="align-self-center">@lang('BTSPlace')</label>
			<table class="table table-responsive-sm table-striped display" id="btstable">
				<thead>
					<tr>
						<th scope="row">#</th>
						<th scope="row">@lang('time')</th>
						<th scope="row">@lang('date')</th>
						<th scope="row">LatLong</th>
						<th scope="row">@lang('BTSAddress')</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>១</td>
						<td>10:30 am</td>
						<td>2021-08-20</td>
						<td>11.77865528, 19.8735278</td>
						<td>Address 1</td>
					</tr>
					<tr>
						<td>១</td>
						<td>10:30 am</td>
						<td>2021-08-20</td>
						<td>11.77865528, 19.8735278</td>
						<td>Address 1</td>
					</tr>
					<tr>
						<td>១</td>
						<td>10:30 am</td>
						<td>2021-08-20</td>
						<td>11.77865528, 19.8735278</td>
						<td>Address 1</td>
					</tr>
					<tr>
						<td>១</td>
						<td>10:30 am</td>
						<td>2021-08-20</td>
						<td>11.77865528, 19.8735278</td>
						<td>Address 1</td>
					</tr>
					<tr>
						<td>១</td>
						<td>10:30 am</td>
						<td>2021-08-20</td>
						<td>11.77865528, 19.8735278</td>
						<td>Address 1</td>
					</tr>
				</tbody>
			</table>
			<div class="py-3"></div>
			<label class="align-self-center">@lang('QRPlace')</label>
			<table class="table table-responsive-sm table-striped display" id="qrtable">
				<thead>
					<tr>
						<th scope="row">@lang('Num')</th>
						<th scope="row">@lang('date')</th>
						<th scope="row">@lang('ShopName')</th>
						<th scope="row" class="text-right">@lang('ShopPhone')</th>
						<th scope="row">@lang('ShopEmail')</th>
						<th scope="row">@lang('commune')</th>
						<th scope="row">@lang('district')</th>
						<th scope="row">@lang('province')</th>
						<th scope="row">@lang('scanResult')</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>១</td>
						<td>សៅ ទិត្យ</td>
						<td>ប្រុស</td>
						<td>25</td>
						<td>មិត្តរួមការងារ</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>២</td>
						<td>សុក្រ ទិត្យ</td>
						<td>ប្រុស</td>
						<td>45</td>
						<td>ពូ</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>៣</td>
						<td>ចន្ទ ទេពី</td>
						<td>ស្រី</td>
						<td>22</td>
						<td>ប្រពន្ធ</td>
						<td>2021-08-22 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>១</td>
						<td>សៅ ទិត្យ</td>
						<td>ប្រុស</td>
						<td>25</td>
						<td>មិត្តរួមការងារ</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>២</td>
						<td>សុក្រ ទិត្យ</td>
						<td>ប្រុស</td>
						<td>45</td>
						<td>ពូ</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>៣</td>
						<td>ចន្ទ ទេពី</td>
						<td>ស្រី</td>
						<td>22</td>
						<td>ប្រពន្ធ</td>
						<td>2021-08-22 10:30 am</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</fieldset>
		<fieldset>
			<legend>@lang('Address work place')</legend>
			
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingName" placeholder="@lang('Name')">
						<label for="floatingName">@lang('Name')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingGender" placeholder="@lang('Gender')">
							<option>@lang('Gender')</option>
						</select>
						<label for="floatingGender">@lang('Gender') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingAge" placeholder="@lang('Age')">
						<label for="floatingAge">@lang('Age')</label>
					</div>
				</div>
			</div>
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="floatingLastRelated" class="form-control" placeholder="@lang('Last Related')">
							<label for="floatingLastRelated">@lang('Last Related')<span class="text-danger">*</span></label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingWarningStatus" placeholder="@lang('Warning status')">
							<option>ខ្ពស់</option>
						</select>
						<label for="floatingWarningStatus">@lang('Warning status')</label>
					</div>
				</div>
			</div>
			<div class="row justify-content-between mb-4">
				<div class="col-md-9">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingAddress" placeholder="@lang('Address')">
						<label for="floatingAddress">@lang('Address')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingEmployee" placeholder="@lang('Employee')">
						<label for="floatingEmployee">@lang('Employee')</label>
					</div>
				</div>
			</div>
			<table class="table table-responsive-sm table-striped display" id="datatable">
				<thead>
					<tr>
						<th scope="row">@lang('Num')</th>
						<th scope="row">@lang('name')</th>
						<th scope="row">@lang('Gender')</th>
						<th scope="row">@lang('Age')</th>
						<th scope="row">@lang('Contacts')</th>
						<th scope="row">@lang('Last Related')</th>
						<th scope="row">@lang('Warning status')</th>
						<th scope="row">@lang('Address')</th>
						<th scope="row">@lang('Employee')</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>១</td>
						<td>សៅ ទិត្យ</td>
						<td>ប្រុស</td>
						<td>25</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>ខ្ពស់</td>
						<td>ភូមិឬស្សី សង្កាត់ស្ទឹងមានជ័យ ខណ្ឌមានជ័យ រាជធានីភ្នំពេញ</td>
						<td>១២</td>
					</tr>
					<tr>
						<td>២</td>
						<td>សៅ ចន្ទ</td>
						<td>ប្រុស</td>
						<td>៣២</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>ខ្ពស់</td>
						<td>សង្កាត់ទំនប់ទឹក ខណ្ឌចំការមន រាជធានីភ្នំពេញ</td>
						<td>១២</td>
					</tr>
					<tr>
						<td>៣</td>
						<td>ចន្ទ​ ទេពី</td>
						<td>ស្រី</td>
						<td>២២</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>ខ្ពស់</td>
						<td>សង្កាត់បឹងកក ខណ្ឌទួលគោក រាជធានីភ្នំពេញ</td>
						<td>១២</td>
					</tr>
					<tr>
						<td>៣</td>
						<td>ចន្ទ​ ទេពី</td>
						<td>ស្រី</td>
						<td>២២</td>
						<td>០១២​៣៤៥​៥៦៧​ , ០៩៦​៩៧៩៨៩៩០</td>
						<td>2021-08-2០ 10:30 am</td>
						<td>ខ្ពស់</td>
						<td>សង្កាត់បឹងកក ខណ្ឌទួលគោក រាជធានីភ្នំពេញ</td>
						<td>១២</td>
					</tr>
				</tbody>
			</table>
		</fieldset>

	</form>

</section>

@stop
@section('scripts')
		<script src="{{url('assets/js/datatables.min.js')}}"></script>
		<script>
			$(document).ready(function() {
					$('#btstable').DataTable( {
							"scrollY":        "200px",
							"scrollCollapse": true,
							"paging":         false,
							"sort": false,
							"searching": false
					} );
					$('#qrtable').DataTable( {
							"scrollY":        "200px",
							"scrollCollapse": true,
							"paging":         false,
							"sort": 					false,
							"searching": false
					} );
			} );
		</script>
@endsection