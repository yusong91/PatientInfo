<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class SettingReport extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Setting Report')))
            ->route('settingReport.report')
            ->icon('fas fa-notes-medical')
            ->active("setting-report")
            ->permissions('settingReport.report');
    }
}