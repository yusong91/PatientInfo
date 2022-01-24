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


        @if($patient->status == 1 && $patient->process_by_step5 != null)
            
            <div class="alert alert-danger" role="alert">
                {{ $patient->general_note }}
            </div>

        @elseif($patient->status_message == 6 )
            
            <div class="alert alert-success" role="alert">
                {{  getTextStatus($patient->status_message) }}
            </div>

        @elseif($patient->status == 6 && $patient->status_message == 7)

            <div class="alert alert-warning" role="alert">
                {{ $interview_status->value }}({{ $patient->superior_descript }})
            </div>

        @endif
     
        <form action="{{ route('list-tasks.fullinterview.store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
            
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            
            <fieldset>
                <legend>@lang('hospital')</legend>
                <input type="hidden" name="id" value="{{ $patient->id }}">
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            <select name="health_facility_id" class="form-control" id="floatingHospital" placeholder="@lang('hospital')" required>
                                <option value="">{{ '--'. __('hospital') .'--' }}</option>
                                @foreach($health_facility as $item)
                                    <option {{ $item->id==$patient->health_facility_id ? 'selected' : '' }} value="{{$item->id}}">{{ $item->value }}</option>
                                @endforeach
                            </select>
                            <label for="floatingHospital">@lang('hospital') <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="form_date" type="text"  id="floatingDob" class="form-control" placeholder="date" value="{{getDateFormat($patient->form_date)}}">
                                <label for="floatingdate">@lang('date') <span class="text-danger">*</span> </label>
                                @error('form_date') <span class="error text-danger">សូមបញ្ចូល  @lang('date')</span> @enderror
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
                            <input value="{{ $patient->form_writer_name }}" name="form_writer_name" type="text" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                            <label for="floatingHospital">@lang('name')</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input value="{{ $patient->form_writer_phone }}" name="form_writer_phone" type="tel" class="form-control" id="floatingPhone" placeholder="@lang('PhoneNum')">
                            <label for="floatingSearch">@lang('PhoneNum')</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- test form -->
            <fieldset>
                <legend>@lang('TestingPurpose')</legend>
                <div class="d-flex mb-4 flex-wrap">

                    @foreach($reason_testing as $item)

                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" type="radio" name="test_reason" value="{{ $item->id }}" id="{{$item->key}}" {{ $item->id==$patient->test_reason ? 'checked' : '' }}>
                            <label class="form-check-label" for="doubt">{{ $item->value}}</label>
                        </div>

                    @endforeach

                </div>

                <div class="form-check form-check-inline d-flex align-items-center mb-3">
                    <label class="form-check-label mr-3" for="socialevent">@lang('RelatedwithCovid')</label>
                    <input class="form-check-input" {{ $patient->direct_exposure==1 ? 'checked' : '' }} value="{{ $patient->direct_exposure }}" name="direct_exposure" type="checkbox" id="socialevent" placeholder="@lang('RelatedwithCovid')">
                </div>
                <div class="row" id="covidRelated">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input value="{{ $patient->exposure_name }}" name="exposure_name" type="text" class="form-control" id="floatingrelated" placeholder="@lang('RelatedCovidName')" {{ $patient->direct_exposure==1 ? "" : 'disabled' }} >
                            <label for="floatingrelated">@lang('RelatedCovidName')</label>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">

                        @foreach($related_patient as $item)
                            <div class="form-check form-check-inline ml-lg-3">
                                <input class="form-check-input" name="exposure_type" type="radio" value="{{$item->id}}" id="{{$item->key}}"  {{ $item->id==$patient->exposure_type ? 'checked' : '' }}>

                                <label class="form-check-label" for="intouch">{{ $item->value }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </fieldset>

            <!-- Patient info -->
            <fieldset>
                <legend>@lang('PatientInfo')</legend>
                <div class="row justify-content-between mb-4">
                    
                    <div class="col-3">
                        <div class="form-floating">
                            <input value="{{ $patient->name }}" type="text"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')" disabled >
                            <label for="floatingHospital">@lang('PatientName')</label>
                            @error('name') <span class="error text-danger">សូមបញ្ចូល @lang('PatientName') </span> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating">
                            <input value="{{ $patient->real_name }}" name="real_name" type="text"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                            <label for="floatingHospital">@lang('realName')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{ $patient->code }}" name="code" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientID')" disabled>
                            <label for="floatingSearch">@lang('PatientID')</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="gender" class="form-control"  id="floatingHospital" placeholder="@lang('Gender')" required>
                                <option value="">{{ '--'. __('Gender') .'--' }}</option>
                                @foreach($gender as $item)
                                    <option {{ $patient->gender==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>
                                @endforeach
                            </select>
                            <label for="floatingHospital">@lang('Gender') <span class="text-danger">*</span></label>
                            @error('gender') <span class="error text-danger">សូមជ្រើសរើស @lang('Gender') </span> @enderror
                        </div>
                    </div> 

                </div>

                <div class="row justify-content-between mb-4">

                    <div class="col-3">
                        <div class="form-floating">
                            <input value="{{ $patient->dob }}"  type="text"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')" disabled>
                            <label for="floatingHospital">@lang('Dob')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->real_dob) }}" name="real_dob" type="text"  class="form-control" id="floatingDob" placeholder="dob">
                                <label for="floatingdob">@lang('realDob')</label>
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

                    <div class="col-3">
                        <div class="form-floating">
                            <input value="{{ $patient->patient_age }}" name="patient_age" type="number"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                            <label for="floatingHospital">@lang('Age')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="nation_id" class="form-control"  id="floatingHospital" placeholder="@lang('Nationality')" required>
                                <option value="">{{ '--'. __('Nationality') .'--' }}</option>
                                @foreach($nation as $item)
                                    <option {{  $patient->nation_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>
                                @endforeach
                            </select>
                            <label for="floatingHospital">@lang('Nationality') <span class="text-danger">*</span></label>
                            @error('nation_id') <span class="error text-danger">សូមបញ្ចូល @lang('Nationality') </span> @enderror
                        </div>
                    </div>

                </div>

                <div class="row justify-content-between mb-4">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{  $patient->phone }}" type="text"  class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')" disabled>
                            <label for="floatingSearch">@lang('PhoneNum')</label>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{ $patient->real_phone }}" name="real_phone" type="text"  class="form-control" placeholder="@lang('PhoneNum')" minlength="9">
                            <label for="floatingSearch">@lang('realPhone') </label>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->positive_date) }}" name="positive_date" type="text"  class="form-control" id="floatingDob" placeholder="dob">
                                <label for="floatingdob">@lang('Positive_date')</label>
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
                            <input value="{{  $patient->job }}" name="job" type="text"  class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
                            <label for="floatingSearch">@lang('Job')</label>
                        </div>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{ $patient->second_phone }}" name="second_phone" type="text"  class="form-control" placeholder="@lang('Second_phone')" minlength="9">
                            <label for="floatingSearch">@lang('Second_phone') </label>
                            
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">				
                        <div class="form-check form-check-inline">
                            <input name="death" class="form-check-input" type="checkbox" {{ $patient->death=='on' ? 'checked' : '' }} >
                            <label class="form-check-label" for="nose">ស្លាប់</label>
                        </div> 
				    </div>

                </div>

                <label class="mb-3">@lang('CurrentAdd')</label>

                <div class="input-group mb-4">
                    <div class="form-floating">
                        <input value="{{  $patient->address }}" name="address" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientAdd')">
                        <label for="floatingSearch">@lang('PatientAdd')</label>
                    </div>
                </div>

                <div class="row justify-content-between mb-4">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="province" class="form-control" id="floatingHospital" placeholder="@lang('CityProvince')">
                                <option value="">{{ '--'. __('CityProvince') .'--' }}</option>
                                @foreach($provinces as $item)
                                    <option {{ $item->code==$patient->province ?  'selected' : '' }} value="{{ $item->code }}">{{ $item->name_kh }}</option>
                                @endforeach
                            </select>
                            <label for="floatingHospital">@lang('CityProvince')</label>
                        </div>
                    </div>
                   
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="district" class="form-control" id="district_id" placeholder="@lang('Commune')">
                                <option value="{{ $patient->district ?? 0 }}">{{ getLabelDistrict($patient->district) ?? '--'. __('Commune') .'--' }}</option>

                            </select>
                            <label for="floatingHospital">@lang('Commune')</label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="commune" class="form-control" id="commune_id" placeholder="@lang('District')">
                                <option value="{{ $patient->commune ?? 0 }}">{{ getLabelCommune($patient->commune)  ?? '--'. __('District') .'--' }}</option>
                            </select>
                            <label for="floatingHospital">@lang('District')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="village" class="form-control" id="village_id" placeholder="@lang('Phumi')">
                                <option value="{{ $patient->village ?? 0 }}">{{ getLabelVillage($patient->village)  ?? '--'. __('Phumi') .'--' }}</option>
                            </select>
                            <label for="floatingHospital">@lang('Phumi')</label>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-between mb-4">
                    
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="{{ $patient->address_description }}" name="address_description" type="text" class="form-control" id="floatingSearch" placeholder="@lang('Other')">
                            <label for="floatingSearch">@lang('Other')</label>
                        </div>
                    </div>

                </div>

                <label class="mb-3 d-block">@lang('ClinicSymptoms')</label>

                <div class="d-flex justify-content-between flex-wrap mb-4">

                    @foreach($clinical_symptom as $item)
                        <div class="form-check form-check-inline mb-3 mb-md-0">
                            <input {{ getSymptom($item->id,$patient->symptom) }} name="clinical_symtom[]" class="form-check-input" type="checkbox" id="fever" value="{{ $item->id }}">
                            <label class="form-check-label" for="fever">{{ $item->value }}</label>
                        </div>
                    @endforeach

                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->symptom_date) }}" name="symptom_date" type="text" class="form-control" id="symptomDate" placeholder="@lang('Analysist')">
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
                    <div class="col-md align-self-center">
                        @lang('GotCovid')

                        @foreach($covid_patient as $item)
                            <div class="form-check form-check-inline ml-3">
                                <input {{ $patient->was_positive==$item->id ? 'checked' : '' }} name="was_positive" class="form-check-input" type="radio" id="{{ $item->key }}" value="{{ $item->id }}">
                                <label class="form-check-label" for="never">{{ $item->value }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <label class="mb-2">@lang('HealthHistory')</label>
                <div class="row justify-content-between mb-4">

                    @foreach($health_history as $item)
                    <div class="col-3 mt-2">
                        <div class="form-check form-check-inline mb-3 mb-md-0">
                            <input {{ getHealth($item->id,$patient->health) }} name="health_histories[]" class="form-check-input" type="checkbox" id="fever" value="{{ $item->id }}">
                            <label class="form-check-label" for="fever">{{ $item->value }}</label>
                        </div>
                    </div>
                    @endforeach

                </div>    

                <label class="mb-3">@lang('TravelHistory')</label>
                <div class="row justify-content-between mb-4">

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input value="{{ $patient->travel_place }}" name="travel_place" type="text" class="form-control" id="floatingCountry" placeholder="@lang('CountryName')">
                            <label for="floatingCountry">@lang('CountryName')</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->travel_date) }}" name="travel_date" type="text" id="arrivedDate" class="form-control" id="floatingArrived" placeholder="@lang('Arrived')">
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

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input value="{{ $patient->travel_no }}" name="travel_no" type="text" class="form-control" id="floatingFlightNumber" placeholder="@lang('FlightNumber')">
                            <label for="floatingFlightNumber">@lang('FlightNumber')</label>
                        </div>
                    </div>

                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input value="{{ $patient->travel_id }}" name="travel_id" type="text" class="form-control" id="floatingIdPassport" placeholder="@lang('IdPassport')">
                            <label for="floatingIdPassport">@lang('IdPassport')</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input value="{{ $patient->travel_chair }}" name="travel_chair" type="text" class="form-control" id="floatingChairNum" placeholder="@lang('ChairNum')">
                            <label for="floatingChairNum">@lang('ChairNum')</label>
                        </div>
                    </div>
                
                </div>

                <div class="row justify-content-between">

                <div class="col-12">
                         <div class="form-floating">
                            <textarea name="travel_description" id="" cols="30" rows="2" class="form-control h-auto" id="description" placeholder="@lang('Description')">{{ $patient->travel_description }}</textarea>
                            <label for="description">@lang('TravelDescription')</label>
                        </div>
                    </div>

                </div>

            </fieldset>

            <!-- Virus Type --> 
            <fieldset>
                <legend>@lang('Variant')</legend>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating">
                            <select name="virus_type" class="form-control" id="floatingHospital" placeholder="@lang('Virus Type')">
                                <option value="0">{{ '--'. __('Variant') .'--' }}</option>
                                @foreach($variant as $item)

                                    <option {{ $patient->virus_type==$item->id ? "selected" : ''}} value="{{$item->id}}">{{ $item->value }}</option>

                                @endforeach

                            </select>
                            <label for="floatingHospital">@lang('Variant')</label>
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
                            <input value="{{ $patient->laboratory_name}}" name="laboratory_name" type="text"  class="form-control" id="floatingTest" placeholder="@lang('TestLocation')">
                            <label for="floatingTest">@lang('TestLocation') <span class="text-danger">*</span></label>
                            @error('laboratory_name') <span class="error text-danger">សូមបញ្ចូល @lang('TestLocation')</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->laboratory_date) }}" name="laboratory_date" type="text" id="testDate" class="form-control" id="floatingTestDate" placeholder="@lang('TestDate')">
                                <label for="floatingTestDate">@lang('TestDate') <span class="text-danger">*</span></label>
                                @error('laboratory_date') <span class="error text-danger">សូមបញ្ចូល @lang('TestDate')</span> @enderror
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
                            <select name="labform_province" class="form-control" id="floatingHospital" placeholder="@lang('CityProvince')" required>
                                <option value="">{{ '--'. __('CityProvince') .'--' }}</option>
                                @foreach($provinces as $item)
                                    <option {{ $item->code==$patient->labform_province ?  'selected' : '' }} value="{{ $item->code }}">{{ $item->name_kh }}</option>
                                @endforeach
                            </select>
                            <label for="floatingHospital">@lang('CityProvince') <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="laboratory_id" class="form-control" id="floatingLabo" placeholder="@lang('Labo')">
                                <option value="0">{{ '--'. __('Labo') .'--' }}</option>
                                @foreach($lab_center as $item)
                                    <option {{ $patient->laboratory_id==$item->id ? 'selected' : ''}}  value="{{ $item->id }}">{{ $item->value }}</option>
                                @endforeach
                            </select>
                            <label for="floatingLabo">@lang('Labo')</label>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-between mb-4">
                    <div class="col-md align-self-center">

                        @lang('TestType')

                        @foreach($type_specimen as $item)
                            <div class="form-check form-check-inline ml-3">
                                <input {{ getObjectTypes($item->id,$patient->objectTypes) }} name="object_types_id[]" class="form-check-input" type="checkbox" id="nose" value="{{$item->id}}">
                                <label class="form-check-label" for="nose">{{$item->value}}</label>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="number_sample_id" class="form-control" id="floatingAnalysist" placeholder="@lang('Analysist')">
                                <option value="0">{{ '--'. __('Analysist') .'--' }}</option>
                                @foreach($number_sample as $item)

                                    <option {{ $item->id==$patient->number_sample_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

                                @endforeach

                            </select>
                            <label for="floatingAnalysist">@lang('Analysist')</label>
                        </div>
                    </div>

                </div>

                <label class="mb-3">@lang('Vaccination')</label>

                <div class="row justify-content-between mb-4">
                    <div class="col-md-3 align-self-center">
                        <div class="form-check form-check-inline">
                            <input {{ $patient->first_vaccine==1 ? 'checked' : '' }} name="first_vaccine" class="form-check-input vaccine1" type="checkbox" id="vaccine1">
                            <label class="form-check-label" for="vaccine1">@lang('Vaccine1')</label>
                        </div>
                    </div>
                    <div class="col-md-3 form-disabled1">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->first_vaccine_date) }}" name="first_vaccine_date" type="text" id="vaccine1Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $patient->first_vaccine==1 ? "" : "disabled" }} >
                                <label for="floatingVaccineDatee">@lang('VaccineDate')</label>
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
                    <div class="col-md-3 form-disabled1">
                        <div class="form-floating">
                            <select name="first_vaccine_type_id" class="form-control" id="floatingVaccineType1" placeholder="@lang('VaccineType')" {{ $patient->first_vaccine==1 ? "" : "disabled" }}>
                                <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                                @foreach($type_vaccine as $item)

                                    <option {{ $patient->first_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

                                @endforeach
                            </select>
                            <label for="floatingVaccineType">@lang('VaccineType')</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between mb-4">
                    <div class="col-md-3 align-self-center">
                        <div class="form-check form-check-inline">
                            <input {{ $patient->second_vaccine==1 ? 'checked' : '' }} name="second_vaccine" class="form-check-input vaccine2" type="checkbox" id="vaccine2">
                            <label class="form-check-label" for="vaccine2">@lang('Vaccine2')</label>
                        </div>
                    </div>
                    <div class="col-md-3 form-disabled2">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->second_vaccine_date) }}" name="second_vaccine_date" type="text" id="vaccine2Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $patient->second_vaccine==1 ? "" : "disabled" }}>
                                <label for="floatingVaccineDatee">@lang('VaccineDate')</label>
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
                    <div class="col-md-3 form-disabled2">
                        <div class="form-floating">
                            <select name="second_vaccine_type_id" class="form-control" id="floatingVaccineType2" placeholder="@lang('VaccineType')" {{ $patient->second_vaccine==1 ? "" : "disabled" }}>
                                <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                                @foreach($type_vaccine as $item)

                                    <option {{  $patient->second_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

                                @endforeach
                            </select>
                            <label for="floatingVaccineType">@lang('VaccineType')</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between mb-4">
                    <div class="col-md-3 align-self-center">
                        <div class="form-check form-check-inline">
                            <input {{ $patient->third_vaccine==1 ? 'checked' : ''  }} name="third_vaccine" class="form-check-input vaccine3" type="checkbox" id="vaccine3">
                            <label class="form-check-label" for="vaccine3">@lang('Vaccine3')</label>
                        </div>
                    </div>
                    <div class="col-md-3 form-disabled3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input value="{{ getDateFormat($patient->third_vaccine_date) }}" name="third_vaccine_date" type="text" id="vaccine3Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $patient->third_vaccine==1 ? "" : "disabled" }}>
                                <label for="floatingVaccineDatee">@lang('VaccineDate')</label>
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
                    <div class="col-md-3 form-disabled3">
                        <div class="form-floating">
                            <select name="third_vaccine_type_id" class="form-control" id="floatingVaccineType3" placeholder="@lang('VaccineType')" {{ $patient->third_vaccine==1 ? "" : "disabled" }}>
                                <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                                @foreach($type_vaccine as $item)

                                    <option {{ $patient->third_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

                                @endforeach
                            </select>
                            <label for="floatingVaccineType">@lang('VaccineType')</label>
                        </div>
                    </div>
                </div>

                <label class="mb-3">@lang('Collector')</label>

                <div class="row justify-content-between mb-3" id="SaveData">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input value="{{ $patient->laboratory_collector }}" name="laboratory_collector" type="text" class="form-control" id="floatingCollectorName" placeholder="@lang('CollctorName')">
                            <label for="floatingCollectorName">@lang('CollctorName')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{ $patient->laboratory_collector_phone }}" name="laboratory_collector_phone" type="text" class="form-control" id="floatingCollectorPhone" placeholder="@lang('CollctorPhone')">
                            <label for="floatingCollectorPhone">@lang('CollctorPhone')</label>
                        </div> 
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </fieldset>

            @csrf
            <button class="btn btn-primary px-5 mt-4 mb-4" type="submit">@lang('Save')</button>   
            
        </form>

        <!-- FAMILY MEMBER -->
        <div class="py-3"></div>
        <fieldset id="AffectedFamily">
            <legend>@lang('AffectedFamily')</legend>
            <form action="{{ route('list-tasks.patientfamily.store') }}" method="post" accept-charset="UTF-8">
                    
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">

                    <input type="hidden" id="family_addedit" name="addedit" value="add">

                    <input type="hidden" id="family_id" name="id">
                    
                    <div class="row justify-content-between mb-4">
                        
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="family_name" placeholder="@lang('AffectedName')" required>
                                <label for="family_name">@lang('AffectedName') <span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control" name="gender" id="family_gender" placeholder="@lang('Gender')" required>
                                <option value="">{{ '--'. __('Gender') .'--' }}</option>
                                    @foreach (getConmunCode('gender') as $item)
                                        <option value="{{ $item->id }}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="family_gender">@lang('Gender') <span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="person_age"  id="family_age" placeholder="@lang('Age')">
                                <label for="family_age">@lang('Age')</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control" required name="family_member"  id="family_member" placeholder="@lang('PatientAs')">
                                <option value="">{{ '--'. __('PatientAs') .'--' }}</option>
                                    @foreach (getConmunCode('family_member') as $item)
                                        <option value="{{$item->id}}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="family_member">@lang('PatientAs') <span class="text-danger">*</span></label>
                                @error('PatientAs') <span class="error text-danger">សូមជ្រើសរើស @lang('PatientAs') </span> @enderror
                            </div>
                        </div>

                    </div> 

                    <div class="row justify-content-between mb-4">

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" required class="form-control" name="phone" id="family_phone" placeholder="@lang('PhoneNum')" minlength="9">
                                <label for="family_phone">@lang('PhoneNum') <span class="text-danger">*</span></label>
                                @error('PhoneNum') <span class="error text-danger">សូមជ្រើសរើស @lang('PhoneNum') </span> @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="second_phone" id="family_second_phone" placeholder="@lang('PhoneNum')" minlength="9">
                                <label for="family_second_phone">@lang('Second_phone')</label>
                               
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control" name="test_result"  id="family_test_result" placeholder="@lang('result')">
                                <option value="">{{ '--'. __('Result') .'--' }}</option>
                                    @foreach (getConmunCode('result') as $item)
                                        <option value="{{ $item->id }}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="family_test_result">@lang('result') </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="form-floating">
                                    <input type="text" id="family_last_touch_date" name="last_touch_date" class="form-control" placeholder="@lang('Last Related')" required>
                                    <label for="family_last_touch_date">@lang('Last Related')<span class="text-danger">*</span></label>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row justify-content-between mb-4">

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="note" rows="2" id="family_note" class="form-control h-auto" placeholder="@lang('Remark')"></textarea>
                                <label for="family_note">@lang('Remark')</label>
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-between">
                   
                        <div class="col-md-3">
                        @csrf
                            <button class="btn btn-primary px-5" type="submit">@lang('Save')</button>
                        </div>
                    </div>

            </form>

            <!-- TABLE family-table -->
            @include('list-tasks.partials.family-table', ['patientFamilyList' => $patientFamilyList])       
        </fieldset>
        <!-- END FAMILY MEMBER -->
                
        <!-- WorkLocation -->
        <div class="py-3"></div> 
        <fieldset id="PersonWorkLocation">
            <legend>@lang('WorkLocation')</legend>
            <label class="mb-3">@lang('PersonWorkLocation')</label>
            <form action="{{ route('list-tasks.patientworkplace.store') }}" method="post" accept-charset="UTF-8">
                <input type="hidden" name="id" value="{{ $patient->id }}">
                <div class="row justify-content-between mb-3">

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{$patient->workplace_name}}" name="workplace_name" type="text"  class="form-control" id="floatingTest" placeholder="@lang('Phone')">
                            <label for="floatingTest">@lang('CompanyName')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{$patient->workplace_company}}" name="workplace_company" type="text"  class="form-control" id="floatingTest" placeholder="@lang('Phone')">
                            <label for="floatingTest">@lang('CompanyStaff')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{$patient->workplace_phone}}" name="workplace_phone" type="text"  class="form-control" id="floatingTest" placeholder="@lang('Phone')" minlength="9">
                            <label for="floatingTest">@lang('PhoneNum')</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input value="{{$patient->workplace_amount_staff}}" name="workplace_amount_staff" type="number"  class="form-control" id="floatingTest" placeholder="@lang('NumberWorker')">
                            <label for="floatingTest">@lang('NumberWorker')</label>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-between mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input value="{{$patient->workplace_address}}" name="workplace_address" type="text"  class="form-control" id="floatingTest" placeholder="@lang('Address')">
                            <label for="floatingTest">@lang('Address')</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="workplace_note" rows="2" id="floatingTest" class="form-control h-auto" placeholder="@lang('Remark')">{{ $patient->workplace_note}}</textarea>
                            <label for="description">@lang('Remark')</label>
                        </div>
                    </div>
                </div>

                @csrf
                <button class="btn btn-primary px-5 mt-4" type="submit">@lang('Save')</button> 
            </form>

        </fieldset>
        <!--END WorkLocation -->

        <div class="py-3"></div>
        <!-- RELATED PATIENT --> 
        <fieldset id="PatientRelatedBlock">
            <legend>@lang('AffectedPlace')</legend>
            <form action="{{ route('patient-related.store') }}" method="POST">
                   
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">

                    <input type="hidden" id="related_addedit" name="related_addedit" value="add">

                    <input type="hidden" id="related_id" name="id">
                    
                    <div class="row justify-content-between mb-4">
                        
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" required class="form-control" name="name"  id="related_name" placeholder="@lang('AffectedName')" required>
                                <label for="related_name">@lang('AffectedName') <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-control" name="gender" id="related_gender" placeholder="@lang('Gender')" required>
                                <option value="">{{ '--'. __('Gender') .'--' }}</option>
                                    @foreach (getConmunCode('gender') as $item)
                                        <option value="{{ $item->id }}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="related_gender">@lang('Gender') <span class="text-danger">*</span></label>
                            </div>
                        </div>
                       
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="age" id="related_age" placeholder="@lang('Age')">
                                <label for="related_age">@lang('Age')</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" required class="form-control" name="phone" id="related_phone" placeholder="@lang('PhoneNum')" minlength="9">
                                <label for="related_phone">@lang('PhoneNum') <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row justify-content-between mb-4">
                        
                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="form-floating">
                                    <input type="text" id="relatedTouchDate" required name="last_date" class="form-control" placeholder="@lang('Last Related')" required>
                                    <label for="floatingLastRelated">@lang('Last Related')<span class="text-danger">*</span></label>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-control" required name="risk_level" id="related_risk" placeholder="@lang('Warning status')">
                                <option value="">{{ '--'. __('Warning status') .'--' }}</option>
                                    @foreach (getConmunCode('risk_level') as $item)
                                        <option value="{{ $item->id }}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="related_risk">@lang('Warning status') <span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="job" id="related_job" placeholder="@lang('PhoneNum')">
                                <label for="related_job">@lang('Job')</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-control" required name="result" id="related_result" placeholder="@lang('Warning status')">
                                <option value="">{{ '--'. __('Result') .'--' }}</option>
                                    @foreach (getConmunCode('result') as $item)
                                        <option value="{{ $item->id }}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                                <label for="related_result">@lang('Result')</label>
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-between mb-4">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="address" id="related_address" placeholder="@lang('Address')">
                                <label for="related_address">@lang('Address')</label>
                            </div> 
                        </div>

                    </div>

                    <div class="row justify-content-between mb-4">

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="note" rows="2" id="related_note" class="form-control h-auto" placeholder="@lang('Remark')"></textarea>
                                <label for="related_note">@lang('Remark')</label>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row justify-content-between mb-4">
                        
                        @csrf
                        <div class="col-md-3">
                            <button class="btn btn-primary px-5" type="submit">@lang('Save')</button>
                        </div>
                    </div>
            </form>

            <!-- TABLE affect-table -->
            @include('list-tasks.partials.affect-table', ['patientRelatedList' => $patientRelatedList])

               
            
        </fieldset>
        <!--END RELATED PATIENT -->

        <div class="py-3"></div>
        <!--DATA TECHNICAL -->
        <fieldset>

            <legend>@lang('DataTechnical')</legend>

            @include('list-tasks.partials.qr-code-table', ['qrCodeList' => $patient->getAttachQrCode])
            <div class="my-4"></div>
            @include('list-tasks.partials.bts-table', ['btsList' => $patient->getAttachBts])

            <label class="mb-3 mt-4">@lang('PatientHistoryTravel')</label>

            <form action="{{ route('list-tasks.patienttravel.store') }}" id="patientTravelStore" method="post" accept-charset="UTF-8">

                <input type="hidden" name="patient_id" value="{{$patient->id}}">

                <input type="hidden" id="addedit" name="addedit" value="add">

                <input type="hidden" id="travel_id" name="travel_id">

                <div class="row justify-content-between mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="location_name" required type="text" class="form-control" id="location_name" placeholder="@lang('LocationName')">
                            <label for="location_name">@lang('LocationName') <span class="text-danger">*</span></label>
                            @error('LocationName') <span class="error text-danger">សូមជ្រើសរើស @lang('LocationName') </span> @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input name="time" required type="text" id="time" class="form-control" placeholder="@lang('Time')">
                            <label for="time">@lang('Time') <span class="text-danger">*</span></label>
                            @error('Time') <span class="error text-danger">សូមជ្រើសរើស @lang('Time') </span> @enderror
                        </div>
                    </div>

                    <div class="col-md-3"> 
                    
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" id="start_date" required name="start_date" class="form-control" placeholder="@lang('Last Related')" required>
                                <label for="start_date">@lang('StartDate') <span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                    
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" id="date" required name="date" class="form-control" placeholder="@lang('Last Related')" required>
                                <label for="date">@lang('EndDate') <span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <img src="{{url("assets/svg/date_picker.svg")}}" alt="date_piker">
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 

                <div class="row justify-content-between mb-2">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="address" required type="text" class="form-control" id="address" placeholder="@lang('Address')">
                            <label for="address">@lang('Address') <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input   type="text" name="note" class="form-control" id="note" placeholder="@lang('Remark')">
                            <label for="note">@lang('Remark')</label>
                        </div>
                    </div>
                </div>
 
                    @csrf
                    <button class="btn btn-primary px-5 mt-4" type="submit">@lang('Save')</button> 

                </form>
                <!--TABLE pati travel-->
                @include('list-tasks.partials.travel-table', ['patientTravelList' => $patientTravelList])
        </fieldset>
            <!--END DATA TECHNICAL -->

            <div class="col-md-3 align-self-end mt-4">
                <a href="{{ route('list-tasks.fullinterview.done', $patient->id) }}" class="btn btn-primary px-5">@lang('BtnDone')</a>
            </div>
            
            <hr>
 
        <!-- Set Send To Research --> 
        <form action="{{ route('list-tasks.full.researchclose') }}" method="post" accept-charset="UTF-8">
            
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <input type="hidden" name="researchorclosecase" id="researchorclosecase">
             
            <fieldset>
                <legend>@lang('SendToResearch') ឬ @lang('CloseCase')</legend>

                <div class="row mb-4"> 

                    <div class="col-4">
                        <div class="form-floating">
                                <select name="close_case" required class="form-control" id="floatingVaccineType3" placeholder="@lang('VaccineType')">
                                <option value="">{{ '--'. __('Status') .'--' }}</option>
                                @foreach($interviewStatusList as $item)
                                <option value="{{ $item->id }}">{{ $item->value }}</option>
                                @endforeach
                                </select>
                                <label for="floatingVaccineType">@lang('Status')</label>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-between mb-4">

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea rows="3" name="description" class="form-control h-auto" id="basic_note" placeholder="@lang('Remark')">{{ $patient->basic_note}}</textarea>
                            <label for="description">@lang('Remark')</label>
                        </div>
                    </div>

                </div>

                @csrf

                <button type="submit" class="btn btn-danger mr-2" onclick="research('send_to_ressearch')">@lang('Send')</button>
        
                <button type="submit" class="btn btn-danger" onclick="closecase()">@lang('Close')</button>
            
            </fieldset>

        </form>
        
    </section>

@stop

@section('scripts')
    <script>

    function research(researchorclosecase){
        
        document.getElementById('researchorclosecase').value = researchorclosecase;
    }

    function closecase(){
        
        document.getElementById('researchorclosecase').value = 'send_to_closecase';
    }

    function editFamily(id){

        if (id){
            
            var url = '{{ route('list-tasks.patientfamily.edit', 'song') }}';
            
            url = url.replace('song', id);
            
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',success: function(data){

                    
                    document.getElementById('family_id').value = data.id;
                    document.getElementById('family_name').value = data.name;
                    document.getElementById('family_gender').value = data.gender;
                    document.getElementById('family_age').value = data.person_age;
                    document.getElementById('family_test_result').value = data.test_result;

                    var date = new Date(data.last_touch_date);
                    var mm = date.getMonth() + 1;
                    var dd = date.getDate();
                    var yy = date.getFullYear();                    
                    document.getElementById('family_last_touch_date').value = dd +'/'+mm+'/'+yy;

                    document.getElementById('family_phone').value = data.phone;
                    document.getElementById('family_member').value = data.family_member;
                    
                    document.getElementById('family_second_phone').value = data.second_phone;
                    document.getElementById('family_note').value = data.note;
                    
                }
            });
        }
    }

    function editRelated(id){

            if (id){
                
                var url = '{{ route('list-tasks.patientrelated.edit', 'song') }}';
                
                url = url.replace('song', id);
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',success: function(data){

                        console.log(data);
                        document.getElementById('related_id').value = data.id;
                        document.getElementById('related_name').value = data.name;
                        document.getElementById('related_gender').value = data.gender;
                        document.getElementById('related_age').value = data.age;
                        document.getElementById('related_result').value = data.result;

                        var date = new Date(data.last_date);
                        var mm = date.getMonth() + 1;
                        var dd = date.getDate();
                        var yy = date.getFullYear();                    
                        document.getElementById('relatedTouchDate').value = dd +'/'+mm+'/'+yy;

                        document.getElementById('related_phone').value = data.phone;
                        document.getElementById('related_risk').value = data.risk_level;
                        document.getElementById('related_address').value = data.address;
                        document.getElementById('related_job').value = data.job;
                        document.getElementById('related_note').value = data.note;
                        
                    }
                });
            }
    }

        function edit(id){

            if (id){
                
                var url = '{{ route('list-tasks.patienttravel.edit', 'song') }}';
                
                url = url.replace('song', id);
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',success: function(data){

                        document.getElementById('travel_id').value = data.id;
                        document.getElementById('addedit').value = 'edit';
                        document.getElementById('location_name').value = data.location_name;
                        document.getElementById('time').value = data.time;
                        
                        var date = new Date(data.date);
                        var mm = date.getMonth() + 1;
                        var dd = date.getDate();
                        var yy = date.getFullYear();
                    
                        document.getElementById('date').value = dd +'/'+mm+'/'+yy;
                        document.getElementById('address').value = data.address;
                        var start_date = new Date(data.start_date);
                        var start_mm = start_date.getMonth() + 1;
                        var start_dd = start_date.getDate();
                        var start_yy = start_date.getFullYear();
                        document.getElementById('start_date').value = start_dd +'/'+start_mm+'/'+start_yy;
                        document.getElementById('note').value = data.note;
                    }
                });
            }
        }

        $('#floatingDob, #checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date, #date, #relatedTouchDate, #family_last_touch_date, #start_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
        });
        // Disabled and Endable checkbox

        $('.socialevent').change(function () {
            if ($(this).is(':checked')) {
                $("div#covidRelated .form-floating, div#covidRelated .form-check").children().prop('disabled', false);
            } else {
                $("div#covidRelated .form-floating,  div#covidRelated .form-check").children().prop('disabled', true);
            }
        });

        // Prob disabled and enable vaccine
        $('.vaccine1').change(function () {
            if ($(this).is(':checked')) {
                $("div.form-disabled1 .form-floating").children().prop('disabled', false);
            } else {
                $("div.form-disabled1 .form-floating").children().prop('disabled', true);
            }
        });
        $('.vaccine2').change(function () {
            if ($(this).is(':checked')) {
                $("div.form-disabled2 .form-floating").children().prop('disabled', false);
            } else {
                $("div.form-disabled2 .form-floating").children().prop('disabled', true);
            }
        });
        $('.vaccine3').change(function () {
            if ($(this).is(':checked')) {
                $("div.form-disabled3 .form-floating").children().prop('disabled', false);
            } else {
                $("div.form-disabled3 .form-floating").children().prop('disabled', true);
            }
        });
 
    </script>

    <script src="{{url('assets/js/datatables.min.js')}}"></script>
    <!-- <script>
			$(document).ready(function() {

                $('#familytable, #affecttable, #traveltable').DataTable( {
                        "scrollY": "200px",
                        "scrollCollapse": true,
                        "paging": false,
                        "sort": false,
                        "searching": false
                } );
			});

        $(document).ready(function() {
            $('#btsTable').DataTable( {
                    "scrollY": "200px",
                    "scrollCollapse": true,
                    "paging": false,
                    "sort": false,
                    "searching": false,
            } );

            $('#qrTable').DataTable( {
                    "scrollY": "200px",
                    "scrollCollapse": true,
                    "paging": false,
                    "sort": false,
                    "searching": false,
            } );
	});

	</script> -->

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        /*province*/
        $(document).ready(function(){
            $('select[name="province"]').on('change', function(){
                var pro_id = $(this).val();
                $('#district_id').empty();
                $('#district_id').append('<option >'+ '--ស្រុក/ខណ្ឌ--'+'</option>');
                $('#commune_id').empty();
                $('#village_id').empty();
                if (pro_id){
                    var url = '{{ route('location.district', 'song') }}';
                    url = url.replace('song', pro_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',success: function(data){

                            $.each(data, function(k, v) {
                                $('#district_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
                            });
                        }
                    });
                }
            });
        });
        /*commune*/
        $(document).ready(function(){
            $('select[name="district"]').on('change', function(){
                var dis_id = $(this).val();
                $('#commune_id').empty();
                $('#commune_id').append('<option >'+ '--ឃុំ/សង្កាត់--'+'</option>');
                $('#village_id').empty();
                if (dis_id){
                    var url = '{{ route('location.commune', 'song') }}';
                    url = url.replace('song', dis_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',success: function(data){
                            $.each(data, function(k, v) {
                                $('#commune_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
                            });
                        }
                    }); 
                } 
            });
        });
        /*village*/
        $(document).ready(function(){
            $('select[name="commune"]').on('change', function(){
                var com_id = $(this).val();
                $('#village_id').empty();
                $('#village_id').append('<option >'+ '--ភូមិ--'+'</option>');
                if (com_id){
                    var url = '{{ route('location.village', 'song') }}';
                    url = url.replace('song', com_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',success: function(data){
                            $.each(data, function(k, v) {
                                $('#village_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@stop
