<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <section class="row mb-5">
            <div class="col-md-7">
                <div class="custom-file">
                    <input id="file-upload" wire:model="importFile" class="custom-file-input @error('import_file') is-invalid @enderror" type="file" name="lab_form">
                    <label for="file-upload" class="custom-file-label">@lang('ChooseFile')</label>
                    @error('import_file')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                @if($importing && !$importFinished)
                    <div wire:poll="updateImportProgress">Importing...please wait.</div>
                @endif

                @if($importFinished)
                    Finished importing.
                @endif
            </div>
            <div class="col-12 text-left mt-4">
                <button type="submit" class="btn btn-primary px-5">@lang('BtnSave')</button>
            </div>
        </section>
    </form>
</div>
