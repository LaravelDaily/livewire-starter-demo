<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.tasks.index', [
            'tasks' => Task::all(),
        ]);
    }
}
