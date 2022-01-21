<?php


namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Tasks extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('Task')))
            ->route('list-tasks')
            ->icon('fas fa-clipboard')
            ->active("list-tasks*")
            ->permissions('task.index');
    }
}