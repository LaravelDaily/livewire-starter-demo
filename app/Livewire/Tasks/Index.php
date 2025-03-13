<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(int $id): void
    {
        Task::where('id', $id)->delete();

        session()->flash('success', 'Task successfully deleted.');
    }

    public function render(): View
    {
        return view('livewire.tasks.index', [
            'tasks' => Task::paginate(5),
        ]);
    }
}
