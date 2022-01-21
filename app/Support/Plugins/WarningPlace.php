<?php


namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class WarningPlace extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Warning place')))
            ->icon('fas fa-exclamation-triangle')
            ->active("warning-place*")
            ->permissions('users.manage');
    }
}