<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PatientReport extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Patient Report')))
            ->route('patients.report')
            ->icon('fas fa-notes-medical')
            ->active("patientReport")
            ->permissions('patients.report');
    }
}