<?php

namespace Vanguard\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Vanguard\Jobs\ExportPatientJob;
use Illuminate\Support\Facades\Bus;

class PatientExportExcell extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false;

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;
        $batch = Bus::batch([
            new ExportPatientJob(),
        ])->dispatch();
        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function downloadExport()
    {
        return Storage::download('public/patient.csv');
    }

    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function render()
    {
        return view('livewire.patient-export-excell');
    }
}
