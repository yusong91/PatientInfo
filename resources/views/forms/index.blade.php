@extends('layouts.app')

@section('content')

<style>
	#covidRelated:not(.show) {
		user-select: none;
	}
</style>

<section>
	<nav aria-label="Page breadcrumb">
		<ol class="breadcrumb form-steps col-md-10 mx-auto">
			<div class="line"></div>
			<li class="breadcrumb-item active" aria-current="page"><span>1</span>@lang('PatientInfo')</li>
			<li class="breadcrumb-item"><span>2</span>@lang('FirstInterview')</li>
			<li class="breadcrumb-item"><span>3</span>@lang('TechnicalInfo')</li>
			<li class="breadcrumb-item"><span>4</span>@lang('FullInterview')</li>
		</ol>
	</nav>

	<form action="">
		<!-- Hospital -->
		<fieldset>
		<legend>@lang('hospital')</legend>
			<div class="row">
				<div class="col">
						<div class="form-floating">
							<select class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
								<option>គ្រឹះស្ថានសុខាភិបាល</option>
							</select>
							<label for="floatingHospital">@lang('hospital')</label>
						</div>
				</div>
				<div class="col">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="checkinDate" class="form-control" id="floatingdate" placeholder="date">
							<label for="floatingdate">@lang('date') <span class="text-danger">*</span> </label>
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
			</div>
		</fieldset>

		<!-- form fill -->
		<fieldset>
			<legend>@lang('FormFiller')</legend>
			<div class="row">
				<div class="col">
						<div class="form-floating">
							<input type="text" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
							<label for="floatingHospital">@lang('name')</label>
						</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input type="tel" class="form-control" id="floatingPhone" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum')</label>
					</div>
				</div>
			</div>
		</fieldset>

		<!-- test form -->
		<fieldset>
			<legend>@lang('TestingPurpose')</legend>
				<div class="d-flex justify-content-between mb-4">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="doubt" value="@lang('Doubt')">
						<label class="form-check-label" for="doubt">@lang('Doubt')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="pneumonia" value="@lang('Pneumonia')">
						<label class="form-check-label" for="pneumonia">@lang('Pneumonia')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="followup" value="@lang('Followup')">
						<label class="form-check-label" for="followup">@lang('Followup')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="nakpaspol" value="@lang('Nakpaspol')">
						<label class="form-check-label" for="nakpaspol">@lang('Nakpaspol')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="mediStaff" value="@lang('MediStaff')">
						<label class="form-check-label" for="mediStaff">@lang('MediStaff')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="nosymptom" value="@lang('NoSymptom')">
						<label class="form-check-label" for="nosymptom">@lang('NoSymptom')</label>
					</div>
				</div>
				<div class="d-flex mb-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="testingpurpose" id="passanger" value="@lang('Passanger')">
						<label class="form-check-label" for="passanger">@lang('Passanger')</label>
					</div>
					<div class="form-check form-check-inline ml-lg-5">
						<input class="form-check-input" type="radio" name="testingpurpose" id="certificate" value="@lang('Certificate')">
						<label class="form-check-label" for="certificate">@lang('Certificate')</label>
					</div>
					<div class="form-check form-check-inline ml-lg-5">
						<input class="form-check-input" type="radio" name="testingpurpose" id="checkup" value="@lang('CheckUp')">
						<label class="form-check-label" for="checkup">@lang('CheckUp')</label>
					</div>
					<div class="form-check form-check-inline ml-lg-5">
						<input class="form-check-input" type="radio" name="testingpurpose" id="socialevent" value="@lang('Event20Feb')">
						<label class="form-check-label" for="socialevent">@lang('Event20Feb')</label>
					</div>
					
				</div>

				<div class="form-check form-check-inline d-flex align-items-center mb-3">
					<label class="form-check-label mr-3" for="socialevent">@lang('RelatedwithCovid')</label>
					<input class="form-check-input socialevent" type="checkbox" id="socialevent" value="@lang('RelatedwithCovid')">
				</div>
				<div class="row" id="covidRelated">
					<div class="col-md-6">
						<div class="form-floating">
							<input type="text" class="form-control" id="floatingrelated" placeholder="@lang('RelatedCovidName')" disabled>
							<label for="floatingrelated">@lang('RelatedCovidName')</label>
						</div>
					</div>
					<div class="col-md-6 align-self-center">
						<div class="form-check form-check-inline ml-lg-3">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="intouch" value="@lang('InTouch')" disabled>
							<label class="form-check-label" for="intouch">@lang('InTouch')</label>
						</div>
						<div class="form-check form-check-inline ml-lg-5">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="notintouch" value="@lang('NotIntouch')" disabled>
							<label class="form-check-label" for="notintouch">@lang('NotIntouch')</label>
						</div>
					</div>
				</div>
		</fieldset>

		<!-- Patient info -->
		<fieldset>
			<legend>@lang('PatientInfo')</legend>
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
						<div class="form-floating">
							<input type="text" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
							<label for="floatingHospital">@lang('PatientName') <span class="text-danger">*</span></label>
						</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientID')" disabled>
						<label for="floatingSearch">@lang('PatientID')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingHospital" placeholder="@lang('Gender')">
							<option>ភេទ</option>
						</select>
						<label for="floatingHospital">@lang('Gender') <span class="text-danger">*</span></label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="dob" class="form-control" id="floatingdob" placeholder="dob">
							<label for="floatingdob">@lang('Dob')</label>
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
						<select class="form-control" id="floatingHospital" placeholder="@lang('Nationality')">
							<option>សញ្ជាតិ</option>
						</select>
						<label for="floatingHospital">@lang('Nationality') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum') <span class="text-danger">*</span></label>
					</div>
				</div>
				
			</div>

			<label class="mb-3">@lang('CurrentAdd')</label>

			<div class="input-group mb-4">
				<div class="form-floating">
					<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientAdd')">
					<label for="floatingSearch">@lang('PatientAdd')</label>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingHospital" placeholder="@lang('CityProvince')">
							<option>ខេត្ត/ក្រុង</option>
						</select>
						<label for="floatingHospital">@lang('CityProvince')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingHospital" placeholder="@lang('Commune')">
							<option>ខណ្ឌ/ស្រុក</option>
						</select>
						<label for="floatingHospital">@lang('Commune')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingHospital" placeholder="@lang('District')">
							<option>ឃុំ/សង្កាត់</option>
						</select>
						<label for="floatingHospital">@lang('District')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingHospital" placeholder="@lang('Phumi')">
							<option>ឃុំ/សង្កាត់</option>
						</select>
						<label for="floatingHospital">@lang('Phumi')</label>
					</div>
				</div>
				<div class="col-md">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingSearch" placeholder="@lang('Other')">
						<label for="floatingSearch">@lang('Other')</label>
					</div>
				</div>
				
			</div>

			<label class="mb-3 d-block">@lang('ClinicSymptoms')</label>
			
			<div class="d-flex justify-content-between mb-4">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="fever" value="@lang('Fever')">
					<label class="form-check-label" for="fever">@lang('Fever')</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="caught" value="@lang('Caught')">
					<label class="form-check-label" for="caught">@lang('Caught')</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="nose" value="@lang('RunnyNose')">
					<label class="form-check-label" for="nose">@lang('RunnyNose')</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="throat" value="@lang('SoreThrough')">
					<label class="form-check-label" for="throat">@lang('SoreThrough')</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="breath" value="@lang('DifficultBreath')">
					<label class="form-check-label" for="breath">@lang('DifficultBreath')</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="nosymptom" value="@lang('NoSymptom')">
					<label class="form-check-label" for="nosymptom">@lang('No')</label>
				</div>
			</div>

			<div class="row mb-4">
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="symptomDate" class="form-control" id="floatingSearch" placeholder="@lang('Analysist')">
							<label for="floatingSearch">@lang('SymptomDate')</label>
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
				<div class="col-md-5 align-self-center">
					@lang('GotCovid')
					<div class="form-check form-check-inline ml-3">
						<input class="form-check-input" type="checkbox" id="never" value="@lang('Never')">
						<label class="form-check-label" for="never">@lang('Never')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="have" value="@lang('Have')">
						<label class="form-check-label" for="have">@lang('Have')</label>
					</div>
				</div>
			</div>

			<label class="mb-3">@lang('TravelHistory')</label>

			<div class="row justify-content-between mb-4">

				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingCountry" placeholder="@lang('CountryName')">
						<label for="floatingCountry">@lang('CountryName')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="arrivedDate" class="form-control" id="floatingArrived" placeholder="@lang('Arrived')">
							<label for="floatingArrived">@lang('Arrived')</label>
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
						<input type="text" class="form-control" id="floatingFlightNumber" placeholder="@lang('FlightNumber')">
						<label for="floatingFlightNumber">@lang('FlightNumber')</label>
					</div>
				</div>

			</div>

			<div class="row justify-content-between mb-4">

				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingIdPassport" placeholder="@lang('IdPassport')">
						<label for="floatingIdPassport">@lang('IdPassport')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingChairNum" placeholder="@lang('ChairNum')">
						<label for="floatingChairNum">@lang('ChairNum')</label>
					</div>
				</div>

				<div class="col-md-3">
					
				</div>
				<div class="col-12 mt-4">
					<div class="form-floating">
						<textarea name="" id="" cols="30" rows="10" class="form-control h-auto" id="description" placeholder="@lang('Description')"></textarea>
						<label for="description">@lang('TravelDescription')</label>
					</div>
				</div>
			</div>

		</fieldset>

		<!-- Labo -->
		<fieldset>
			<legend>@lang('ForLabo')</legend>
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingTest" placeholder="@lang('TestLocation')">
						<label for="floatingTest">@lang('TestLocation') <span class="text-danger">*</span></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="testDate" class="form-control" id="floatingTestDate" placeholder="@lang('TestDate')">
							<label for="floatingTestDate">@lang('TestDate') <span class="text-danger">*</span></label>
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
						<select class="form-control" id="floatingLabo" placeholder="@lang('Labo')">
							<option>មន្ទីរពិសោធន៍</option>
						</select>
						<label for="floatingLabo">@lang('Labo')</label>
					</div>
				</div>
				
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-5 align-self-center">
					@lang('TestType')
					<div class="form-check form-check-inline ml-3">
						<input class="form-check-input" type="checkbox" id="nose" value="@lang('TestNose')">
						<label class="form-check-label" for="nose">@lang('TestNose')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="throat" value="@lang('Throat')">
						<label class="form-check-label" for="throat">@lang('Throat')</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="other" value="@lang('Other')">
						<label class="form-check-label" for="other">@lang('Other')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select class="form-control" id="floatingAnalysist" placeholder="@lang('Analysist')">
							<option>វត្ថុវិភាគលើកទី</option>
						</select>
						<label for="floatingAnalysist">@lang('Analysist')</label>
					</div>
				</div>

			</div>

			<label class="mb-3">@lang('Vaccination')</label>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vaccine1" value="@lang('Vaccine1')">
						<label class="form-check-label" for="vaccine1">@lang('Vaccine1')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="vaccine1Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')">
							<label for="floatingVaccineDatee">@lang('VaccineDate') <span class="text-danger">*</span></label>
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
						<select class="form-control" id="floatingVaccineType" placeholder="@lang('VaccineType')">
							<option>ប្រភេទវ៉ាក់សាំង</option>
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vaccine2" value="@lang('Vaccine2')">
						<label class="form-check-label" for="vaccine2">@lang('Vaccine2')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="vaccine2Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')">
							<label for="floatingVaccineDatee">@lang('VaccineDate') <span class="text-danger">*</span></label>
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
						<select class="form-control" id="floatingVaccineType" placeholder="@lang('VaccineType')">
							<option>ប្រភេទវ៉ាក់សាំង</option>
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vaccine3" value="@lang('Vaccine3')">
						<label class="form-check-label" for="vaccine3">@lang('Vaccine3')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input type="text" id="vaccine3Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')">
							<label for="floatingVaccineDatee">@lang('VaccineDate') <span class="text-danger">*</span></label>
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
						<select class="form-control" id="floatingVaccineType" placeholder="@lang('VaccineType')">
							<option>ប្រភេទវ៉ាក់សាំង</option>
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<label class="mb-3">@lang('Collector')</label>

			<div class="row justify-content-between mb-3">
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingCollectorName" placeholder="@lang('CollctorName')">
						<label for="floatingCollectorName">@lang('CollctorName')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input type="text" class="form-control" id="floatingCollectorPhone" placeholder="@lang('CollctorPhone')">
						<label for="floatingCollectorPhone">@lang('CollctorPhone')</label>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>

			<div class="row justify-content-between">
				<div class="col-md-4">
					<label>@lang('ChooseDoc')</label>
				</div>
				<div class="col-md-7">
					<div class="custom-file">
						<input id="file-upload" class="custom-file-input" type="file" name="">
						<label for="file-upload" class="custom-file-label">@lang('ChooseFile')</label>
					</div>
				</div>
				<div class="col-12 text-right mt-4">
					<button class="btn btn-primary px-5">@lang('BtnSave')</button>
				</div>
			</div>
		</fieldset>

	</form>

</section>

@stop

@section('scripts')
<script>
	$('.socialevent').change(function () {
			if ($(this).is(':checked')) {
					$("div#covidRelated .form-floating, div#covidRelated .form-check").children().prop('disabled', false);
			} else {
					$("div#covidRelated .form-floating,  div#covidRelated .form-check").children().prop('disabled', true);
			}
	});
</script>
<script>
	$('#checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date').datepicker({
			uiLibrary: 'bootstrap4'
	});
</script>
<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@stop