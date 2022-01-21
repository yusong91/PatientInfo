<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class PatientInfo extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Patient Info')))
            ->route('patients')
            ->icon('fas fa-notes-medical')
            ->active("patients*")
            ->permissions('patient.index');
    }
}