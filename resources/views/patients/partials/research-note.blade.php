<div class="row justify-content-between mt-4">
    <div class="col-12">

        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        <input type="hidden" name="basic_interview" id="basic_interview" value="store" >

        <div class="form-floating">
            <textarea rows="3" name="basic_note" class="form-control h-auto" id="basic_note" placeholder="@lang('Remark')">{{ $patient->basic_note}}</textarea>
            <label for="description">@lang('Remark')</label>
        </div>
    </div>
</div>