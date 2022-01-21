<div>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    {{--    <form wire:submit.prevent="savePatient" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">--}}
    <form wire:submit.prevent="savePatient" enctype="multipart/form-data" accept-charset="UTF-8">
        <!-- Hospital -->
        @csrf
        <fieldset>
            <legend>@lang('hospital')</legend>
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <select wire:model="health_facility_id" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                            <option value="0">{{ '--'. __('hospital') .'--' }}</option>
                            @foreach($health_facility as $item)
                                <option {{ $item->id==old("health_facility_id") ? 'selected' : '' }} value="{{$item->id}}">{{ $item->value }}</option>
                            @endforeach
                        </select>
                        <label for="floatingHospital">@lang('hospital')</label>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model.debounce="form_date" type="text"  id="datepicker" class="form-control" placeholder="date">
                            <label for="floatingdate">@lang('date') <span class="text-danger">*</span> </label>
                            @error('form_date') <span class="error text-danger">{{ $message }}</span> @enderror
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
                        <input wire:model="form_writer_name" type="text" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                        <label for="floatingHospital">@lang('name')</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input wire:model="form_writer_phone" type="tel" class="form-control" id="floatingPhone" placeholder="@lang('PhoneNum')">
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
                        <input wire:model="test_reason" class="form-check-input" type="radio" id="{{$item->key}}" value="{{ $item->id }}">
                        <label class="form-check-label" for="doubt">{{ $item->value}}</label>
                    </div>

                @endforeach

            </div>

            <div class="form-check form-check-inline d-flex align-items-center mb-3">
                <label class="form-check-label mr-3" for="socialevent">@lang('RelatedwithCovid')</label>
                <input wire:model="direct_exposure"  class="form-check-input socialevent" type="checkbox" id="socialevent">
            </div>
            <div class="row" id="covidRelated">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input wire:model="exposure_name" type="text" class="form-control" id="floatingrelated" placeholder="@lang('RelatedCovidName')" disabled>
                        <label for="floatingrelated">@lang('RelatedCovidName')</label>
                    </div>
                </div>
                <div class="col-md-6 align-self-center">

                    @foreach($related_patient as $item)

                        <div class="form-check form-check-inline ml-lg-3">
                            <input wire:model="exposure_type" class="form-check-input" type="radio" value="{{  $item->id }}" disabled>
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
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="name" type="text"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
                        <label for="floatingHospital">@lang('PatientName') <span class="text-danger">*</span></label>
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="code" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientID')" disabled>
                        <label for="floatingSearch">@lang('PatientID')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="gender" class="form-control" required  id="floatingHospital" placeholder="@lang('Gender')">
                            <option value="0">{{ '--'. __('Gender') .'--' }}</option>
                            @foreach($sex as $item)
                                <option value="{{ $item->id }}">{{ $item->value }}</option>
                            @endforeach
                        </select>
                        <label for="floatingHospital">@lang('Gender') <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="dob" type="text"  class="form-control" id="floatingDob" placeholder="dob">
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
                        <select wire:model="nation_id" class="form-control"  id="floatingHospital" placeholder="@lang('Nationality')">
                            <option value="0">{{ '--'. __('Nationality') .'--' }}</option>
                            @foreach($nationality as $item)

                                <option value="{{ $item->id }}">{{ $item->value }}</option>

                            @endforeach
                        </select>
                        <label for="floatingHospital">@lang('Nationality') <span class="text-danger">*</span></label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating">

                        <input wire:model="phone" type="text"  class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
                        <label for="floatingSearch">@lang('PhoneNum') <span class="text-danger">*</span></label>
                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <label class="mb-3">@lang('CurrentAdd')</label>

            <div class="input-group mb-4">
                <div class="form-floating">
                    <input wire:model="address" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientAdd')">
                    <label for="floatingSearch">@lang('PatientAdd')</label>
                </div>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="province" wire:select="selectProvince" class="form-control" id="floatingHospital" placeholder="@lang('CityProvince')">
                            <option value="0">{{ '--'. __('CityProvince') .'--' }}</option>
                            @foreach($provinces as $item)
                                <option value="{{ $item->province_code }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingHospital">@lang('CityProvince')</label>
                    </div>
                </div>
                @if($districts)
                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="district" class="form-control" id="district_id" placeholder="@lang('Commune')">
                            <option value="0">{{ '--'. __('Commune') .'--' }}</option>
                            @foreach($districts as $item)
                                <option value="{{ $item->province_code }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingHospital">@lang('Commune')</label>
                    </div>
                </div>
                @endif
                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="commune" class="form-control" id="commune_id" placeholder="@lang('District')">

                        </select>
                        <label for="floatingHospital">@lang('District')</label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="village" class="form-control" id="village_id" placeholder="@lang('Phumi')">

                        </select>
                        <label for="floatingHospital">@lang('Phumi')</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input wire:model="address_description" type="text" class="form-control" id="floatingSearch" placeholder="@lang('Other')">
                        <label for="floatingSearch">@lang('Other')</label>
                    </div>
                </div>

            </div>

            <label class="mb-3 d-block">@lang('ClinicSymptoms')</label>

            <div class="d-flex justify-content-between flex-wrap mb-4">

                @foreach($clinical_symptom as $item)
                    <div class="form-check form-check-inline mb-3 mb-md-0">
                        <input wire:model="clinical_symtom[]" class="form-check-input" type="checkbox" id="fever" value="{{ $item->id }}">
                        <label class="form-check-label" for="fever">{{ $item->value }}</label>
                    </div>
                @endforeach

            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="symptom_date" type="text" class="form-control" id="symptomDate" placeholder="@lang('Analysist')">
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
                            <input wire:model="was_positive" class="form-check-input" type="checkbox" id="never" value="{{ $item->key }}">
                            <label class="form-check-label" for="never">{{ $item->value }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <label class="mb-3">@lang('TravelHistory')</label>

            <div class="row justify-content-between mb-4">

                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="travel_place" type="text" class="form-control" id="floatingCountry" placeholder="@lang('CountryName')">
                        <label for="floatingCountry">@lang('CountryName')</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="travel_date" type="text" id="arrivedDate" class="form-control" id="floatingArrived" placeholder="@lang('Arrived')">
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
                        <input wire:model="travel_no" type="text" class="form-control" id="floatingFlightNumber" placeholder="@lang('FlightNumber')">
                        <label for="floatingFlightNumber">@lang('FlightNumber')</label>
                    </div>
                </div>

            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="travel_id" type="text" class="form-control" id="floatingIdPassport" placeholder="@lang('IdPassport')">
                        <label for="floatingIdPassport">@lang('IdPassport')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="travel_chair" type="text" class="form-control" id="floatingChairNum" placeholder="@lang('ChairNum')">
                        <label for="floatingChairNum">@lang('ChairNum')</label>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-12 mt-4">
                    <div class="form-floating">
                        <textarea wire:model="travel_description" id="" cols="30" rows="10" class="form-control h-auto" id="description" placeholder="@lang('Description')"></textarea>
                        <label for="description">@lang('TravelDescription')</label>
                    </div>
                </div>
            </div>

        </fieldset>

        <!-- Virus Type -->
        <fieldset>
            <legend>@lang('Virus Type')</legend>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating">
                        <select wire:model="virus_type" class="form-control" id="floatingHospital" placeholder="@lang('Virus Type')">
                            <option value="0">{{ '--'. __('Virus Type') .'--' }}</option>
                            @foreach($variant as $item)

                                <option value="{{$item->id}}">{{ $item->value }}</option>

                            @endforeach

                        </select>
                        <label for="floatingHospital">@lang('Virus Type')</label>
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
                        <input wire:model="laboratory_name" type="text"  class="form-control" id="floatingTest" placeholder="@lang('TestLocation')">
                        <label for="floatingTest">@lang('TestLocation') <span class="text-danger">*</span></label>
                        @error('laboratory_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="laboratory_date" type="text" id="testDate" class="form-control" id="floatingTestDate" placeholder="@lang('TestDate')">
                            <label for="floatingTestDate">@lang('TestDate') <span class="text-danger">*</span></label>
                            @error('laboratory_date') <span class="error text-danger">{{ $message }}</span> @enderror
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
                        <select wire:model="laboratory_id" class="form-control" id="floatingLabo" placeholder="@lang('Labo')">
                            <option value="0">{{ '--'. __('Labo') .'--' }}</option>
                            @foreach($lab_center as $item)
                                <option value="{{ $item->id }}">{{ $item->value }}</option>
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
                            <input wire:model="object_types_id[]" class="form-check-input" type="checkbox" id="nose" value="{{$item->id}}">
                            <label class="form-check-label" for="nose">{{$item->value}}</label>
                        </div>
                    @endforeach

                </div>

                <div class="col-md-3">
                    <div class="form-floating">
                        <select wire:model="number_sample_id" class="form-control" id="floatingAnalysist" placeholder="@lang('Analysist')">
                            <option value="0">{{ '--'. __('Analysist') .'--' }}</option>
                            @foreach($number_sample as $item)

                                <option value="{{ $item->id }}">{{ $item->value }}</option>

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
                        <input wire:model="first_vaccine" class="form-check-input vaccine1" type="checkbox" id="vaccine1">
                        <label class="form-check-label" for="vaccine1">@lang('Vaccine1')</label>
                    </div>
                </div>
                <div class="col-md-3 form-disabled1">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="first_vaccine_date" type="text" id="vaccine1Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" disabled>
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
                <div class="col-md-3 form-disabled1">
                    <div class="form-floating">
                        <select wire:model="first_vaccine_type_id" class="form-control" id="floatingVaccineType1" placeholder="@lang('VaccineType')" disabled>
                            <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                            @foreach($type_vaccine as $item)

                                <option value="{{ $item->id }}">{{ $item->value }}</option>

                            @endforeach
                        </select>
                        <label for="floatingVaccineType">@lang('VaccineType')</label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3 align-self-center">
                    <div class="form-check form-check-inline">
                        <input wire:model="second_vaccine" class="form-check-input vaccine2" type="checkbox" id="vaccine2">
                        <label class="form-check-label" for="vaccine2">@lang('Vaccine2')</label>
                    </div>
                </div>
                <div class="col-md-3 form-disabled2">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="second_vaccine_date" type="text" id="vaccine2Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" disabled>
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
                <div class="col-md-3 form-disabled2">
                    <div class="form-floating">
                        <select wire:model="second_vaccine_type_id" class="form-control" id="floatingVaccineType2" placeholder="@lang('VaccineType')" disabled>
                            <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                            @foreach($type_vaccine as $item)

                                <option value="{{ $item->id }}">{{ $item->value }}</option>

                            @endforeach
                        </select>
                        <label for="floatingVaccineType">@lang('VaccineType')</label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-md-3 align-self-center">
                    <div class="form-check form-check-inline">
                        <input wire:model="third_vaccine" class="form-check-input vaccine3" type="checkbox" id="vaccine3">
                        <label class="form-check-label" for="vaccine3">@lang('Vaccine3')</label>
                    </div>
                </div>
                <div class="col-md-3 form-disabled3">
                    <div class="input-group">
                        <div class="form-floating">
                            <input wire:model="third_vaccine_date" type="text" id="vaccine3Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" disabled>
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
                <div class="col-md-3 form-disabled3">
                    <div class="form-floating">
                        <select wire:model="third_vaccine_type_id" class="form-control" id="floatingVaccineType3" placeholder="@lang('VaccineType')" disabled>
                            <option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
                            @foreach($type_vaccine as $item)

                                <option value="{{ $item->id }}">{{ $item->value }}</option>

                            @endforeach
                        </select>
                        <label for="floatingVaccineType">@lang('VaccineType')</label>
                    </div>
                </div>
            </div>

            <label class="mb-3">@lang('Collector')</label>

            <div class="row justify-content-between mb-3">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="laboratory_collector" type="text" class="form-control" id="floatingCollectorName" placeholder="@lang('CollctorName')">
                        <label for="floatingCollectorName">@lang('CollctorName')</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input wire:model="laboratory_collector_phone" type="text" class="form-control" id="floatingCollectorPhone" placeholder="@lang('CollctorPhone')">
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
                        <input wire:model="laboratory_file" id="file-upload" class="custom-file-input" type="file" name="laboratory_file">
                        <label for="file-upload" class="custom-file-label">@lang('ChooseFile')</label>
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="col-12 text-right mt-4">
                    <button type="submit" class="btn btn-primary px-5">@lang('BtnSave')</button>
                </div>
            </div>
        </fieldset>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D MMM YYYY',
        onSelect: function() {
            // console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>
