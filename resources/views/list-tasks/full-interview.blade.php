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

		<!-- Patient info -->
		<fieldset>
			<legend>@lang('CurrentAdd')</legend>
			<div class="row mb-4">
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="AuthorCode" placeholder="@lang('AuthorCode')" value="{{$patient->code}}" disabled>
						<label for="AuthorCode">@lang('AuthorCode')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingPatientName" placeholder="@lang('PatientName')" value="{{$patient->name}}" disabled>
						<label for="floatingPatientName">@lang('PatientName')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingPatientNameInterview" placeholder="@lang('PatientNameInterview')" value="{{$patient->form_writer_name}}" disabled>
						<label for="floatingPatientNameInterview">@lang('PatientNameInterview')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingGender" placeholder="@lang('floatingGender')" value="{{$patient->sex->value}}" disabled>
						<label for="floatingGender">@lang('Gender')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingDob" placeholder="@lang('floatingDob')" value="{{getDateFormat($patient->dob)}}" disabled>
						<label for="floatingDob">@lang('Dob')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingNationality" placeholder="@lang('Nationality')" value="{{$patient->nation->value ?? ""}}" disabled>
						<label for="floatingNationality">@lang('Nationality')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingJob" placeholder="@lang('Job')" disabled>
						<label for="floatingJob">@lang('Job')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingSocialMedia" placeholder="@lang('SocialMedia')" disabled>
						<label for="floatingSocialMedia">@lang('SocialMedia')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingIDCard" placeholder="@lang('IDCard')" value="{{$patient->travel_id}}" disabled>
						<label for="floatingIDCard">@lang('IDCard')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingPhoneNumbers" placeholder="@lang('PhoneNumbers')" value="{{$patient->phone}}" disabled>
						<label for="floatingPhoneNumbers">@lang('PhoneNumbers')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingAge" placeholder="@lang('Age')" value="{{$patient->age}}" disabled>
						<label for="floatingAge">@lang('Age')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingPermanentAddress" placeholder="@lang('PermanentAddress')" value="{{$patient->address}}" disabled>
						<label for="floatingPermanentAddress">@lang('PermanentAddress')</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingVaccinated" placeholder="@lang('Vaccinated')" value="{{$patient->vaccine_description}}" disabled>
						<label for="floatingVaccinated">@lang('Vaccinated')</label>
					</div>
				</div>
			</div>


            @include('list-tasks.partials.bts-table', ['btsList' => $patient->getAttachBts])
            <div class="my-4"></div>
            @include('list-tasks.partials.qr-code-table', ['qrCodeList' => $patient->getAttachQrCode])

		</fieldset>
        
        <div class="py-3"></div>
        <fieldset id="PatientHistoryBlock">
        <legend>@lang('CovidHistory') </legend>

        <form action="{{ route('patient-history.store') }}" method="POST">
            @csrf
            <input type="hidden" name="patient_id" value="{{$patient->id}}">
            <input type="hidden" name="id" value="{{$patientHistory->id}}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select name="was_positive" class="form-control" id="floatingUsedToCovid" placeholder="@lang('UsedToCovid')">
                            @foreach (getConmunCode('covid_patient') as $item)
                                <option {{ $item->id == $patientHistory->was_positive ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                            @endforeach
                        </select>
                        <label for="floatingUsedToCovid">@lang('UsedToCovid') </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cured_place" value="{{$patientHistory->cured_place}}" id="floatingCuredPlace" placeholder="@lang('CuredPlace')">
                        <label for="floatingCuredPlace">@lang('CuredPlace')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="injection_source" value="{{$patientHistory->injection_source}}" id="floatingSuspiciousOfInfection" placeholder="@lang('SuspiciousOfInfection')">
                        <label for="floatingSuspiciousOfInfection">@lang('SuspiciousOfInfection')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" name="test_date" value="{{getDateFormat($patientHistory->test_date)}}" id="TestDate" class="form-control" placeholder="@lang('TestCovidDate')">
                            <label for="TestDate">@lang('TestCovidDate')</span></label>
                        </div>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="test_reason"  id="floatingTestReason" placeholder="@lang('TestReason')">
                            @foreach (getConmunCode('reason_testing') as $item)
                                <option {{ $item->id == $patientHistory->test_reason ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                            @endforeach
                        </select>
                        <label for="floatingTestReason">@lang('TestReason') </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="test_place"  id="floatingTestPlace" placeholder="@lang('TestPlace')">
                            @foreach (getConmunCode('lab_center') as $item)
                                <option {{ $item->id == $patientHistory->test_place ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                            @endforeach
                        </select>
                        <label for="floatingTestPlace">@lang('TestPlace') </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="test_result" id="floatingResult" placeholder="@lang('Result')">
                            @foreach (getConmunCode('result') as $item)
                                <option {{ $item->id == $patientHistory->test_reason ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                            @endforeach
                        </select>
                        <label for="floatingResult">@lang('Result') </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" name="result_date" value="{{getDateFormat($patientHistory->result_date)}}" id="ResultDate" class="form-control" placeholder="@lang('ResultDate')">
                            <label for="testDate">@lang('ResultDate')</span></label>
                        </div>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="symptoms" value="{{$patientHistory->symptoms}}" class="form-control" id="floatingSymptoms" placeholder="@lang('Symptoms')">
                        <label for="floatingSymptoms">@lang('Symptoms')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" name="symptoms_date" value="{{getDateFormat($patientHistory->symptoms_date)}}" id="SymptomsDate" class="form-control" placeholder="@lang('SymptomsDate')">
                            <label for="testDate">@lang('SymptomsDate')</span></label>
                        </div>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary px-5" type="submit">@lang('Save')</button>
                </div>
            </div>
        </form>
    </fieldset>



		<fieldset id="PatientRelatedBlock">
			<legend>@lang('AffectedPlace')</legend>
			<form action="{{ route('patient-related.store') }}" method="POST">
                @csrf
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="id" value="{{$patientRelated->id}}">
                <div class="row justify-content-between mb-4">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" value="{{$patientRelated->name}}" id="floatingAffectedName" placeholder="@lang('AffectedName')" required>
                            <label for="floatingAffectedName">@lang('AffectedName') <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-control" name="gender" id="floatingGender" placeholder="@lang('Gender')" required>
                                @foreach (getConmunCode('gender') as $item)
                                    <option {{ $item->id == $patientRelated->gender ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                                @endforeach
                            </select>
                            <label for="floatingGender">@lang('Gender') <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="age" value="{{$patientRelated->age}}" id="floatingAge" placeholder="@lang('Age')">
                            <label for="floatingAge">@lang('Age')</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="phone" value="{{$patientRelated->phone}}" id="floatingSearch" placeholder="@lang('PhoneNum')">
                            <label for="floatingSearch">@lang('PhoneNum')</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" id="InfectedDate" name="last_date" value="{{getDateFormat($patientRelated->last_date)}}" class="form-control" placeholder="@lang('Last Related')" required>
                                <label for="floatingLastRelated">@lang('Last Related')<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-control" name="risk_level" id="floatingWarningStatus" placeholder="@lang('Warning status')">
                                @foreach (getConmunCode('risk_level') as $item)
                                    <option {{ $item->id == $patientRelated->risk_level ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                                @endforeach
                            </select>
                            <label for="floatingWarningStatus">@lang('Warning status')</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-control" name="type_id" value="{{$patientRelated->type_id}}"  id="floatingPlace" placeholder="@lang('Place')">
                                @foreach (getConmunCode('related_place') as $item)
                                    <option {{ $item->id == $patientRelated->type_id ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                                @endforeach
                            </select>
                            <label for="floatingPlace">@lang('Place')</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="member_no" value="{{$patientRelated->member_no}}" id="floatingEmployee" placeholder="@lang('Employee')">
                            <label for="floatingEmployee">@lang('Employee')</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-control" name="as"  id="floatingPatientAs" placeholder="@lang('PatientAs')">
                                @foreach (getConmunCode('as') as $item)
                                    <option {{ $item->id == $patientRelated->as ? 'selected' : '' }} value="{{ $item->id }}">{{$item->value}}</option>
                                @endforeach
                            </select>
                            <label for="floatingPatientAs">@lang('PatientAs') </label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4">
                    <div class="col-md-7">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="address" value="{{$patientRelated->address}}" id="floatingAddress" placeholder="@lang('Address')">
                            <label for="floatingAddress">@lang('Address')</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary px-5" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
		</fieldset>

        <div class="py-3"></div>
        <label class="align-self-center">@lang('AffectedInfo')</label>
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
                    <th scope="row">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patientRelatedList as $item) 
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->age}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{getDateFormat($item->last_date)}}</td>
                        <td>{{$item->risk->value ?? ""}}</td>
                        <td>{{$item->address}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button id="my-dropdown" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                    @permission('patient-related.edit')
                                        <a href="{{ route('list-tasks.fullinterview',['id'=>$patient->id]).'?related_id='.$item->id."#PatientRelatedBlock" }}" class="dropdown-item text-gray">
                                            <i class="fas fa-edit mr-2"></i>
                                            @lang('Edit')
                                        </a>
                                    @endpermission
                                    @permission('patient-related.delete')
                                        <a data-toggle="modal" data-target="#patientRelatedModel-{{$item->id}}" class="dropdown-item text-gray">
                                            <i class="fas fa-trash mr-2"></i>
                                            @lang('Delete')
                                        </a>
                                    @endpermission
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="patientRelatedModel-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="patientRelatedModelLabel" aria-hidden="true">
                        <form action="{{ route('patient-related.delete') }}">
                            <input type="hidden" name="id" value="{{ $item->id }}" >
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="patientRelatedModelLabel">បញ្ជាក់</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        តើពិតជាចង់លុប អ្នកប៉ះពាល់នេះមែនទេ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ទេ</button>
                                        <button type="submit" class="btn btn-danger">លុប</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @empty 
                    <tr class="text-center">
                        <td colspan="9">@lang('NoData')</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
</section>
@stop
 
@section('scripts')
        <script>
            $('#TestDate, #ResultDate, #SymptomsDate, #InfectedDate').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy',
            });
        </script>

		<script src="{{url('assets/js/datatables.min.js')}}"></script>
		<script>
			$(document).ready(function() {
                $('#btsTable').DataTable( {
                        "scrollY": "500px",
                        "scrollCollapse": true,
                        "paging": false,
                        "sort": false,
                        "searching": false,
                } );
                $('#qrTable').DataTable( {
                        "scrollY": "500px",
                        "scrollCollapse": true,
                        "paging": false,
                        "sort": false,
                        "searching": false,
                } );
			});
		</script>
@endsection