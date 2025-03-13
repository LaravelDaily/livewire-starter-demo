<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate('required|string|max:255')]
    public string $name;

    #[Validate('nullable|boolean')]
    public bool $is_completed;

    public Task $task;

    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->name = $task->name;
        $this->is_completed = $task->is_completed;
    }

    public function save(): void
    {
        $this->validate();

        $this->task->update([
            'name'         => $this->name,
            'is_completed' => $this->is_completed,
        ]);

        session()->flash('success', 'Task successfully created.');

        $this->redirectRoute('tasks.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.tasks.edit');
    }
}
