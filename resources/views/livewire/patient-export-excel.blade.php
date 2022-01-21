<div>
    <a wire:click="export" class="btn btn-outline-primary ml-3">Export</a>

    @if($exporting && !$exportFinished)
        <div class="d-inline" wire:poll="updateExportProgress">Exporting...please wait.</div>
    @endif

    @if($exportFinished)
        Done. Download file <a class="stretched-link" wire:click="downloadExport">here</a>
    @endif
</div>
