<?php


namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Summary extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Summary')))
            ->route('dashboard')
            ->icon('fas fa-chart-pie')
            ->active("/")
            ->permissions('dashboard');
    }
}