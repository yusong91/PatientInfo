<?php


namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class TasksDone extends Plugin
{
    public function sidebar()
    {
        return Item::create(__(\Lang::get('TaskDone')))
            ->route('list-tasks.done')
            ->icon('fas fa-clipboard')
            ->active("list-tasks/done")
            ->permissions('task.index'); 
    }
}